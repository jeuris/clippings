window.onload = function()
{
	document.fieldCount = 0;
}

function addField(target, name)
{
	var goalHolder = target
	var description = document.getElementById('description');
	
	var container = document.createElement('div');
	container.id = 'container' + document.fieldCount;
	container.name = 'container' + document.fieldCount;
	var button = document.createElement('button');
	
	button.className = 'button';
	button.innerHTML = 'verwijder';
	button.style.marginBottom = '10px';
	button.id = 'container' + document.fieldCount;
	button.name = 'container' + document.fieldCount;
	
	var goal = document.createElement('input');
	goal.style.marginBottom = '10px';
	goal.style.marginRight = '10px';
	goal.style.width = '480px';
	goal.type='text';
	goal.className = 'validate:{required:true, minlength:3}}';
	
	if(target.id == 'goalHolder')
	{
		goal.name = 'goals[]';
	}
	else
	{
		goal.name = 'links[]';
	}

	if(name != null && name != "")
	{
		goal.value = name;
	}
	
	
	container.appendChild(goal);
	container.appendChild(button);

	goalHolder.appendChild(container);	
	
	button.onclick = function()
	{
		removeField(this.name, target);
	}	
	
	var goalHolder = document.getElementById('goalHolder');
	var linkHolder = document.getElementById('linkHolder');
	
	description.style.height = ((40 * (goalHolder.children.length + linkHolder.children.length)) + 115) + 'px';
	document.fieldCount ++;
}



function addCombinedField(target, lName, lUrl)
{
	var linkHolder = target
	var description = document.getElementById('description');
	
	var container = document.createElement('div');
	container.id = 'container' + document.fieldCount;
	container.name = 'container' + document.fieldCount;
	var button = document.createElement('button');
	
	button.className = 'button';
	button.innerHTML = 'verwijder';
	button.style.marginBottom = '10px';
	button.id = 'container' + document.fieldCount;
	button.name = 'container' + document.fieldCount;
	
	var linkName = document.createElement('input');
	linkName.style.marginBottom = '10px';
	linkName.style.marginRight = '10px';
	linkName.style.width = '240px';
	linkName.type='text';
	linkName.className = 'validate:{required:true, minlength:3}}';
	linkName.name = 'linkName[]';
	linkName.placeholder = 'naam'
	
	var linkUrl = document.createElement('input');
	linkUrl.style.marginBottom = '10px';
	linkUrl.style.marginRight = '10px';
	linkUrl.style.width = '240px';
	linkUrl.type='text';
	linkUrl.className = 'validate:{required:true, minlength:3}}';
	linkUrl.name = 'linkUrl[]';
	linkUrl.placeholder = 'url';
	
	
	if(lName != null && lName != "")
	{
		linkName.value = lName;
	}
	
	if(lUrl != null && lUrl != "")
	{
		linkUrl.value = lUrl;
	}

	container.appendChild(linkName);
	container.appendChild(linkUrl);
	container.appendChild(button);
	linkHolder.appendChild(container);
	
	button.onclick = function()
	{
		removeField(this.name, target);
	}	
	
	var goalHolder = document.getElementById('goalHolder');
	var linkHolder = document.getElementById('linkHolder');
	
	description.style.height = ((40 * (goalHolder.children.length + linkHolder.children.length)) + 115) + 'px';
	document.fieldCount ++;
}


function removeField(value, holder)
{
	var description = document.getElementById('description');
	var goalHolder = document.getElementById('goalHolder');
	var linkHolder = document.getElementById('linkHolder');
	
	holder.removeChild(document.getElementById(value));
	
	description.style.height = ((40 * (goalHolder.children.length + linkHolder.children.length)) + 115) + 'px';
}


function displayUpload(holder)
{
	if (holder.hasChildNodes())
	{
	    while (holder.childNodes.length >= 1)
	    {
	        holder.removeChild(holder.firstChild);       
	    } 
	}
	
	var fileUploader = document.createElement('input');
	fileUploader.type = 'file';
	fileUploader.id = 'file';
	fileUploader.name = 'file';
	fileUploader.className = 'file';
	fileUploader.value = 'upload afbeelding';
	

	
	holder.appendChild(fileUploader);
}


















