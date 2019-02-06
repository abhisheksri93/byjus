<?php
/**
 * Created by PhpStorm.
 * User: abhishekRst
 * Date: 06-02-2019
 * Time: 15:34
 */
?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script>
        var app = angular.module('byjus', []);
    </script>

    <script type="text/javascript" src="<?= base_url() ?>assets/js/forms.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/paging.js"></script>

    <style>
        .error {
            color: #FF0000
        }
    </style>
</head>
<body ng-app="byjus">
<div ng-controller="taxationCntrl">
    <h3>
        Users ( {{ count }} )
    </h3>
    <form method="post" name="addTax" ng-submit="addUser()">
        <div class="form-group">
            <label>User Name</label>
            <input type="text" class="form-control" id="userName" name="userName"
                   ng-model="insert.userName">
            <span class="error" ng-show="errorUserName">{{errorUserName}}</span>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" id="email" name="email"
                   ng-model="insert.email">
            <span class="error" ng-show="errorEmail">{{errorEmail}}</span>
        </div>
        <div class="form-group">
            <label>Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile"
                   ng-model="insert.mobile">
            <span class="error" ng-show="errorMobile">{{errorMobile}}</span>
        </div>
        <button type="submit" class="btn-submit" id="" name="">Save</button>
    </form>

    <hr>
    <div>
        <span class="alert alert-success" ng-show="successInsert">{{successInsert}}</span>
        <form method="post" name="search_filter" id="search_filter" ng-submit="getUserData()">
            <input type="text" placeholder="Search" name="search_by" ng-model="search.search_by"
                   value="">
            <input type="submit" id="sbtbtn" name="sub-btn">
        </form>
        <table class="table table-striped" cellpadding="0" cellspacing="0">
            <thead>
            <th> Name</th>
            <th> Email</th>
            <th> Phone No.</th>
            </thead>
            <tbody>
            <tr ng-repeat="tax in taxation">
                <td>{{ tax.userName }}</td>
                <td>{{ tax.email }}</td>
                <td>{{ tax.mobile }}</td>
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