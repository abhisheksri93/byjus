<?php
/**
 * Created by PhpStorm.
 * User: abhisheksrivastava
 * Date: 2019-02-06
 * Time: 22:09
 */ ?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .error {
            color: #FF0000
        }
    </style>
</head>
<body>
<div>
    <h3>
        Byju's Exam
    </h3>
    <div>
        <table class="table table-striped" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
                <td><a href="<?= base_url() ?>public/byjus/overwriteLinks">Answer 1</a></td>
            </tr>
            <tr>
                <td><a href="<?= base_url() ?>public/byjus/linkedIn-login">Answer 2</a></td>
            </tr>
            <tr>
                <td><a href="<?= base_url() ?>public/byjus/ecryptedData">Answer 3</a></td>
            </tr>
            <tr>
                <td><a href="<?= base_url() ?>public/byjus/fetchEmail">Answer 4</a></td>
            </tr>
            <tr>
                <td><a href="<?= base_url() ?>public/byjus/calculateFucntion">Answer 5</a></td>
            </tr>
            </tbody>
        </table>
        <paging
                page="currentPage"
                page-size="10"
                total="count"
                text-first="first"
                text-last="last"
                text-next="next"
                text-prev="prev"
                show-prev-next="true"
                show-first-last="true"
                paging-action="getUserData(page,pageSize)">
        </paging>
        <br/>
    </div>

</div>
</body>
</html>