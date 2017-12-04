<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{!! $recipe->title !!}</title>
	<style type="text/css">
	body {
		font-family: "sans-serif";
	}
	h2{
		color:#F34E32;
		font-size: 24px;
		margin:0;
		font-weight:normal;
	}
	p{
		color:#967B76;
		font-size: 14px;
		margin:0;
		line-height:20px;
	}
	</style>
</head>


<table style="background:#444444; padding: 10px 30px; width: 100% !important;">
	<tr>
		<td>
			<img src="{{asset('/assets/frontend/images/logo.png')}}" alt="=Nurtured For Living Logo" width="150"/>
		</td>
	</tr>
</table>
<table style="width: 100% !important;">
	<tr> <td> <img src="{{ asset( $recipe->list_image ) }}" /> </td> </tr>
</table>
<table style="background:#84A22F; color:#ffffff; padding: 5px 30px; width: 100% !important;">
	<tr>
		<td>
			{!! $recipe->title !!}
		</td>
	</tr>
</table>

<table>
	<tr>
		<td>
			{!! $recipe->instructions !!}
		</td>
	</tr>
</table>
