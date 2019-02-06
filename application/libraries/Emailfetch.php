<?php
/**
 * Created by PhpStorm.
 * User: Abhishek Srivastava
 * Date: 25-04-2018
 * Time: 12:56
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Emailfetch
{
    private $CI;
    public $connection;
    public $messageNumber;
    public $bodyHTML = '';
    public $reference_id = '';
    public $bodyPlain = '';
    public $attachments;
    public $getAttachments = true;
    public $mailSubject = '';
    public $mailFrom = '';
    public $mailPerson = '';
    public $mailHost = '';
    public $mailTime = '';
    public $ticket = '';
    public $ticketThread = '';
    public $vendorDetail = '';
    public $charset = 'UTF-8';

    public function __construct($config_data = array())
    {
        $this->CI =& get_instance();
        if ($config_data) {
            $this->connection = $config_data['connection'];
            $this->messageNumber = isset($config_data['message_no']) ? $config_data['message_no'] : 1;
        }
    }

    public function fetch()
    {
        $structure = @imap_fetchstructure($this->connection, $this->messageNumber);
        if (!$structure) {
            return false;
        } else {
            if (isset($structure->parts)) {
                $this->recurse($structure->parts);
            }
            return true;
        }
    }

    public function recurse($messageParts, $prefix = '', $index = 1, $fullPrefix = true)
    {
        foreach ($messageParts as $part) {
            $partNumber = $prefix . $index;
            if ($part->type == 0) {
                if (isset($part->parameters)) {
                    if ($part->parameters[0]->attribute == 'CHARSET') {
                        $this->charset = $part->parameters[0]->value;
                        switch ($this->charset):
                            case 'us-ascii':
                                $this->charset = 'UTF-8';
                                break;
                            case 'iso-8859-9':
                                $this->charset = 'UTF-8';
                                break;
                            case 'iso-8859-3':
                                $this->charset = 'UTF-8';
                                break;
                            default :
                                break;
                        endswitch;
                    }
                }
                if ($part->subtype == 'PLAIN') {
                    $this->bodyPlain .= $this->getPart($partNumber, $part->encoding);
                } else {
                    $this->bodyHTML .= $this->getPart($partNumber, $part->encoding);
                }
            } elseif ($part->type == 2) {
                /*$msg = new VendorQuoteTicket(array('connection' => $this->connection, 'message_no' => $this->messageNumber));
                $msg->getAttachments = $this->getAttachments;
                if (isset($part->parts)) {
                    $msg->recurse($part->parts, $partNumber . '.', 0, false);
                }
                $this->attachments[] = array(
                    'type' => $part->type,
                    'subtype' => $part->subtype,
                    'filename' => '',
                    'data' => $msg,
                    'inline' => false,
                );*/
            } elseif (isset($part->parts)) {
                if ($fullPrefix) {
                    $this->recurse($part->parts, $prefix . $index . '.');
                } else {
                    $this->recurse($part->parts, $prefix);
                }
            } elseif ($part->type > 2) {
                if (isset($part->id)) {
                    $id = str_replace(array('<', '>'), '', $part->id);
                    $this->attachments[$id] = array(
                        'type' => $part->type,
                        'subtype' => $part->subtype,
                        'filename' => $this->getFilenameFromPart($part),
                        'data' => $this->getAttachments ? $this->getPart($partNumber, $part->encoding) : '',
                        'inline' => true,
                    );
                } else {
                    $this->attachments[] = array(
                        'type' => $part->type,
                        'subtype' => $part->subtype,
                        'filename' => $this->getFilenameFromPart($part),
                        'data' => $this->getAttachments ? $this->getPart($partNumber, $part->encoding) : '',
                        'inline' => false,
                    );
                }
            }
            $index++;
        }
    }

    public function getPart($partNumber, $encoding)
    {
        $data = imap_fetchbody($this->connection, $this->messageNumber, $partNumber);
        $this->setHeaderValues();
        switch ($encoding) {
            case 0:
                return $data; // 7BIT
            case 1:
                return imap_8bit($data); // 8BIT
            case 2:
                return $data; // BINARY
            case 3:
                return base64_decode($data); // BASE64
            case 4:
                $charset = new Charset();
                return $charset->utf8(imap_qprint($data), $this->charset);
            case 5:
                return $data; // OTHER
            default:
                return $data; // Default
        }
    }

    public function setHeaderValues()
    {
        $objHeader = imap_headerinfo($this->connection, $this->messageNumber);

        $this->mailSubject = utf8_decode(imap_utf8($objHeader->subject));
        $splitSubject = explode(' ', $this->mailSubject);

        foreach ($splitSubject as $spSub) {
            $spSub = trim($spSub);
            if (is_numeric($spSub)) {
                if (strlen($spSub) > 8) {
                    $query = $this->CI->db->select()->from('applications')->where('reference_id', $spSub)->get();
                    if ($query->num_rows() > 0) {
                        $this->reference_id = $query->row_array()['reference_id'];
                        break;
                    }
                }
            }
        }

        $aFrom = $objHeader->from;
        $this->mailFrom = utf8_decode(imap_utf8($aFrom[0]->mailbox)) . "@" . utf8_decode(imap_utf8($aFrom[0]->host));
        $this->mailPerson = isset($aFrom[0]->personal) ? utf8_decode(imap_utf8($aFrom[0]->personal)) : '';
        $this->mailHost = utf8_decode(imap_utf8($aFrom[0]->host));
        $this->mailTime = utf8_decode(imap_utf8($objHeader->MailDate));
    }

    public function getFilenameFromPart($part)
    {
        $filename = '';
        if ($part->ifdparameters) {
            foreach ($part->dparameters as $object) {
                if (strtolower($object->attribute) == 'filename') {
                    $filename = $object->value;
                }
            }
        }
        if (!$filename && $part->ifparameters) {
            foreach ($part->parameters as $object) {
                if (strtolower($object->attribute) == 'name') {
                    $filename = $object->value;
                }
            }
        }
        return $filename;
    }

    public function get_mail_body($body_type = 'html')
    {
        $mail_body = '';
        if ($body_type == 'html') {
            $this->fetch();

            $insData = array(
                'email_from' => $this->mailFrom,
                'email_host' => $this->mailHost,
                'email_person' => $this->mailPerson,
                'subject' => $this->mailSubject,
                'mailContent' => htmlspecialchars($this->bodyHTML, ENT_QUOTES, $this->charset),
                'createdDate' => strtotime($this->mailTime),
            );

            if (!empty($this->attachments)) {
                foreach ($this->attachments as $key => $attach) {
                    $insData['attachments'][] = $attach['filename'];
                }
            }
        } else {
            $mail_body = $this->bodyPlain;
        }

        return $insData;
    }
}