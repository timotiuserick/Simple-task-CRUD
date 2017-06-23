<html>
	<head>
		<title>Simple task</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	</head>

	<body>
		<div>
			<form>
				Task ID  (read-only) : <input type="text" name="id" id="input-id" readonly="true"><br>
				Task name: <input type="text" name="name" id="input-name"><br>
				Task description: <input type="text" name="description" id="input-description"><br>
				<span style="background-color: yellow" onclick="insertTask()">INSERT</span>
				<span style="background-color: orange" onclick="updateTask()">UPDATE</span>
			</form>
		</div>

		<div>
			<h1>CURRENT TASK</h1>
			<table id="tasks">
				
			</table>
		</div>
	</body>

<script>
$( document ).ready(function() {
    getTasks();
})

var selectedId = '34';

function getTasks() {
  $.ajax({
    'type' : 'get',
    'url' : window.location.href + 'methods/get_tasks.php',
    'success' : function(resp){
      try {
      	newContent = '';

      	newContent += '<tr><td>Id</td>' +
						'<td>Name</td>' +
						'<td>Description</td>' +
						'<td>Date created</td>' +
						'<td>Date updated</td><td></td><td></td></tr>';

		ids = '';
        for (index = 0; index < resp.length; index++) {
    		newContent += '<tr><td>' + resp[index].id + '</td>' +
    							'<td>' + resp[index].name + '</td>' +
    							'<td>' + resp[index].description + '</td>' +
    							'<td>' + resp[index].dateCreated + '</td>' +
    							'<td>' + resp[index].dateUpdated + '</td>' +
    							"<td><button id=" + resp[index].id + ">EDIT</button></td>" +
    							"<td><button id=delete-" + resp[index].id + ">DELETE</button></td></tr>";

    		ids += resp[index].id + ';';
    	}

    	$('#tasks').html(newContent);

		ids = ids.split(';');
    	for (index = 0; index < resp.length; index++) {
    		selectedId = ids[index];
    		
    		document.getElementById(ids[index]).onclick = (function() { 
    			var currId = selectedId;
			    return function() { 
			        prepareToEdit(currId);
			    }
    		})();

    		document.getElementById('delete-' + ids[index]).onclick = (function() { 
    			var currId = selectedId;
			    return function() { 
			        deleteTask(currId);
			    }
    		})();
    	}

      } catch (e) {
        return false;
      }
    }
  });
}

function prepareToEdit(id) {
	document.getElementById('input-id').value = id;
}

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function insertTask() {
  newName = document.getElementById('input-name').value;
  newDescription = document.getElementById('input-description').value;

  if (newName == '' || newDescription == '') {
  	alert('Insert name and description');
  	return false;
  }

  newId = makeid();

  $.ajax({
    'type' : 'post',
    'url' : window.location.href + 'methods/post_tasks.php',
    'data' : {
        name : newName,
        description : newDescription,
        id : newId
    },
    'success' : function(resp){
      try {
      	alert('Successful insert new task');
      } catch (e) {
        return false;
      }
    }
  });

  getTasks();
}

function updateTask(id) {
  newName = document.getElementById('input-name').value;
  newDescription = document.getElementById('input-description').value;
  id = document.getElementById('input-id').value;
  if (id == undefined || id == '') {
  	alert('Select a task');
  	return false;
  }

  $.ajax({
    'type' : 'post',
    'url' : window.location.href + 'methods/update_tasks.php',
    'data' : {
        name : newName,
        description : newDescription,
        id : id
    },
    'success' : function(resp){
      try {
      	alert('Successful update task');
      } catch (e) {
        return false;
      }
    }
  });

  getTasks();
}

function deleteTask(id) {
  $.ajax({
    'type' : 'post',
    'url' : window.location.href + 'methods/delete_tasks.php',
    'data' : {
        id : id
    },
    'success' : function(resp){
      try {
      	alert('Successful delete task');
      } catch (e) {
        return false;
      }
    }
  });

  getTasks();
}
</script>
</html>