<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      .maincontent{
        text-align: center;

      }
      .left{
        float: left;
      }
      .right{
        float: right;
      }
    </style>
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById("maincontent").innerHTML;
            w=window.open();
            w.document.write(printContents);
            w.print();
            w.close();
        }
    </script>

  </head>
  <body>
    <div class="maincontent">
      <div class="left">
        this is left
      </div>
      <div class="right">
        this is right
      </div>
      <button class='print' onclick="printDiv()" value="Print">Print</button>
    </div>
  </body>
  <script type="text/javascript">
      function printDiv() {
        console.log('hello');
          var printContents = document.getElementById("maincontent").innerHTML;
          w=window.open();
          w.document.write(printContents);
          w.print();
          w.close();
      }
  </script>

</html>
