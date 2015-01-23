{literal}
<script type="text/javascript">
 function atn(id, veiksmas, tipai)
{ 


	var ajaxRequest;
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	


{/literal}
	var appx = Math.random();
{literal}
	if (typeof tipai == 'undefined' ){ var tipai=""; var priedas="";}else{var priedas="a";}	
{/literal}
	var queryString = "?kuris="+id+"&veiksmas="+veiksmas+"&tipai="+tipai+"&appx="+appx;
	ajaxRequest.open("GET", "/modules/Zemelapiai/upd-stat.php" + queryString, true);
	ajaxRequest.send(null); 


{literal}

ajaxRequest.onreadystatechange=function() {
  if(ajaxRequest.readyState == 4) {
	var lmn = ajaxRequest.responseText;

        if (lmn != ""){ 
	 if (veiksmas=="settrue"){
	         document.getElementById(false+"-"+priedas+id).style.display = 'none';
	         document.getElementById(true+"-"+priedas+id).style.display = 'block';
	 }

	 if (veiksmas=="setfalse"){
	         document.getElementById(false+"-"+priedas+id).style.display = 'block';
	         document.getElementById(true+"-"+priedas+id).style.display = 'none';
	 }
        }
  }
}




} 


</script>
{/literal}




<script>
{literal}
function suskleisti(kalba) {
 document.getElementById(kalba).style.display='none';

document.getElementById(kalba+'-s').style.display='none';
document.getElementById(kalba+'-i').style.display='block';
}

function isskleisti(kalba, dydis){

 document.getElementById(kalba).style.display='inline';
document.getElementById(kalba).style.display='block';
document.getElementById(kalba+'-i').style.display='none';
document.getElementById(kalba+'-s').style.display='block'
}
{/literal}
</script>

{literal}
<script>
 function gener (id) {
	var masyv;
	var keiciamas=document.getElementById('k-'+id).value;
	var nuoroda=document.getElementById('l-'+id).href;
	var nlink = "";
	var masyv=nuoroda.split("&");
	var kiek=masyv.length;
	for (i=0; i<kiek; i++){
	 masyv2=masyv[i].split("=");
	 if (masyv2[0] == "m1_npoz") {
	   masyv[i] = masyv2[0]+"="+keiciamas;
	 }
	  nlink = nlink+masyv[i]+"&";
	}
	document.getElementById('l-'+id).href = nlink;

 }
</script>
{/literal}

{*<a href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact=TxForm,m1_,reimport,0">Reimport</a>*}

<div class="pageoptions">
	<p class="pageoptions">{$addlink}</p>
</div>
<tbody>
<table cellspacing="0" class="pagetable">
		<thead>
			<tr>
				<th width="10px"><div>&nbsp;</div></th>
				<th width="20px" style="text-align:center"><div>ID</div></th>
				<th width="300px"><div>Pavadinimas</div></th>
				<th  width="200px"><div>Alias</div></th>
				<th  width="200px"></th>
				<th  width="10px" class="pageicon"><div>Ištrinti</div></th>
			</tr>
		</thead>
</tbody>
<tbody id='lt'>
{assign var='nmb' value='0'}
			{foreach from=$prop_array_lt item=entry}
{assign var='nmb' value=$nmb+1}
				<tr class="row1" onmouseover="this.className='row1hover';" onmouseout="this.className='row1';" id='lt-{$nmb}'>
					<td><div></div></td><td style="text-align:center"><div {if $entry->spec}style='color: #d22310'{/if}>{$entry->formid}</div></td>
					<td><div><a href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact=TxForm,m1_,addedit,0&prop_id={$entry->id}">{$entry->formname}</a></div></td>
					<td><div>{$entry->formalias}</div></td>
					<td>{if $entry->storedb}<div><a href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact=TxForm,m1_,download_export,0&prop_id={$entry->id}">Download</a></div>{/if}</td>
					<td><div><a href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact=TxForm,m1_,addedit,0&prop_id={$entry->id}">edit</a>&nbsp;{if $allow_del == "yes"}|&nbsp;<a onclick="if(!confirm('ar tikrai?')) return false;" href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact=TxForm,m1_,deleteprop,0&prop_id={$entry->id}">delete</a>{/if}</div></td>
				</tr>
				<tr style="height: 0px">
				<td colspan="6">
				</td>
				</tr>
			{/foreach}
</tbody>


<tbody>
<tr>
<td></td><td></td>
</tr>
		</tbody>

</table>

<div class="pageoptions">
	<p class="pageoptions">{$addlink}</p>
</div>


