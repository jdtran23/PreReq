function getXMLHTTPRequest() {
	var req = false;
	try 
	{
		req = new XMLHttpRequest();
	} catch (err){
		try 
		{
			req = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (err) {
			req = false;
		}
	}
	return req;
}
/*
function addSubSkill(skill, subskill){
	var phpPage = 'subskillScript.php';
	var urlLink = phpPage + "?skill="+skill+"&subkskill="subskill;
	subskillReq.open("GET", urlLink, true);
	//To be completed
}*/