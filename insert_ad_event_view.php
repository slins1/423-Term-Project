<html>
<head>
<title>Add an Ad Event</title>
</head>

<body>

<h1>Add an Ad Event</h1>
<hr/>

 <form action="insert_adEvent.php" method="post">
 <table>
  <tr>
    <td align="left">EventCode:</td>
    <td align="left"><input type="text" name="eventCode" id="eventCode" maxlength=25 size=20></td>
  </tr>
  <tr>
    <td align="left">Name:</td>
    <td align="left"><input type="text" name="name" id="name" maxlength=25 size=20></td>
  </tr>
  <tr>
    <td align="left">Start Date:</td>
    <td align="left"><input type="text" name="startDate" id="startDate" maxlength=25 size=20></td>
  </tr>
  <tr>
    <td align="left">End Date:</td>
    <td align="left"><input type="text" name="endDate" id="endDate" maxlength=25 size=20></td>
  </tr>
  <tr>
    <td align="left">Description:</td>
    <td align="left"><input type="text" name="description" id="description" maxlength=100 size=35></td>
  </tr>
  <tr>
    <td align="left">Type:</td>
    <td align="left"><input type="text" name="type" id="type" maxlength=10 size=5></td>
  </tr>
 </table>

 <button type="submit" value="submit">Submit Information</button>
 <button type="reset" value="reset">Reset</button>

 </form>

 </body>
 </html>