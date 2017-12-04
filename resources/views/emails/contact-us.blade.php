<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Nurtured For Living | Contact Us Form Submission</title>
  <style type="text/css">

  </style>
</head>
  <body>

    <p>There was an enquiry from the contact us form with the following details:</p>
    <p>
      Name: {!! $data['name'] !!}<br/>
      Email: {!! $data['email'] !!}<br/>
      Department: {!! $data['department'] !!}<br/>
    </p>

    <p>
      Message: <br/>
      {!! $data['message'] !!}<br/>
    </p>


  </body>
</html>