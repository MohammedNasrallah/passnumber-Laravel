<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password | Company Name</title>
  <style>
    .btn-success {
      color: #fff;
      background-color: #5cb85c;
      border-color: #4cae4c;
  }
  .btn {
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-decoration: none;
    transition: 0.5s all;
  }
  .btn-success:hover {
      color: #fff;
      background-color: #449d44;
      border-color: #398439;
  }
  .btn.focus, .btn:focus, .btn:hover {
      color: #333;
      text-decoration: none;
  }
  .button-holder
  {
    margin:0 auto;
  }
  .button-holder a {
    display: block;
    width: 150px;
    padding: 15px;
    font-size: 1.3rem;
    font-weight: bold;
    margin: 30px auto;
}
    </style>
</head>
<body>
  <img src="http://crystalaironline.com/images/logoround%20good179x180.png" alt="" style="display:block;margin:20px auto; width: 100px; height: auto;">
  <div class="paragraph">
    Dear User, <br>
    <p>You have requested to reset your password. Complete the process by clicking the below link.</p>
  </div>
  <div class="button-holder">
    <a href='{{ url("/panel/superadmin/forgot/$email/$code") }}' class="btn btn-success">Reset Password</a>
  </div>
  <div class="thanks">
    Thanks
    <br>
    <b>Company Name</b>
  </div>
</body>
</html>