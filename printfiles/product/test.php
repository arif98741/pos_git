<!DOCTYPE html>
<html>
<head>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <meta charset="utf-8">
    <title>::: STAFF-LIST:::</title>
    <link rel="stylesheet" href="../../assets/css/print.css" type="text/css" media="screen">
    <link rel="stylesheet " href="../../assets/css/print.css">
</head>

<body>
<div class="bt-div">
    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="প্রিন্ট">
    <button class="button blue" onclick="goBack()">পিছনে</button>
</div>
<div class="wraper">
    <table width="100%" border="0" class="header">
        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../photo/photos2018-01-12-15-07-03_5a58c10707ece.png" class="img_div" width="60"
                                height="60" alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1">বসুরহাট সরকারী উচ্চ বিদ্যালয়</div>

                <div class="title-3">কর্মচারী তালিকা</div>
            </td>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">সর্বমোট শিক্ষক সংখ্যা: (0) জন</div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>
    <table class="TFtable" id="datatable">
        <thead>
        <tr>
            <th align="left" valign="top">আইডি</th>
            <th align="left" valign="top">নাম</th>
            <th align="left" valign="top">পদবী</th>
            <th align="left" valign="top">মোবইল নম্বর</th>
            <th align="left" valign="top">যোগদান</th>
            <th align="left" valign="top">শিক্ষাগত যোগ্যতা</th>
        </tr>
        </thead>
        <tbody>
    </table>

</div>
</body>
</html>