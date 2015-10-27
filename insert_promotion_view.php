 <html>
 <head>
    <title> Add a Promotion page </title>
</head>
 <body>
<div>
<div align="left"><h4>Aptaris<br/>Promotion System</h4></div>
<h1 align="center">Insert A Promotion</h1>
</div>
<hr/>
 <form action="insert_promotion.php" method="post">
    <table>
        <tr>
            <td align="left">Promotion Name:</td>
                <td align="left"><input type="text" name="name" id="name" maxlength=25 size=20></td>
        </tr>
        <tr>
            <td align="left">Description:</td>
            <td align="left"><input type="text" name="description" id="description" maxlength=100 size=35></td>
        </tr>
        <tr>
            <td align="left">Amount Off:</td>
            <td align="left"><input type="text" name="amountOff" id="amountOff" maxlength=10 size=5></td>
        </tr>
        <tr>
            <td align="left">Promo Type:</td>
            <td align="left"><input type="text" name="promoType" id="promoType" maxlength=10 size=5></td>
        </tr>
    </table>

<button type="submit" value="submit">Submit Information </button>
<button type="reset" value="reset">Reset</button>
</form>

</body>
</html>