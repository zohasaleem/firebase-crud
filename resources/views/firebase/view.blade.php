
<script>
var firebaseConfig = {
	apiKey: "AIzaSyAjIP5tHqh8TUUIelfJOnXk0p0gOoY8bcY",
	authDomain: "uploadimage-6caaa.firebaseapp.com",
	databaseURL: "https://uploadimage-6caaa-default-rtdb.firebaseio.com",
	projectId: "uploadimage-6caaa",
	storageBucket: "uploadimage-6caaa.appspot.com",
	messagingSenderId: "241344153012",
	appId: "1:241344153012:web:1429e19b86399d19d2dee1",
	measurementId: "G-3G8GJ1S54S"

};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);


var storage = firebase.storage();

function uploadImage() {
    var fileInput = document.getElementById('imageInput');
    var file = fileInput.files[0];
    if (file) {
        var storageRef = storage.ref();
        var imageRef = storageRef.child('newimages/' + file.name);
		imageRef.put(file).then(function(snapshot) {
            console.log('Image uploaded successfully.');

            // Get the download URL of the uploaded image
            imageRef.getDownloadURL().then(function(url) {
                console.log('Download URL:', url);
			
			}).catch(function(error) {
                console.error('Error getting download URL: ' + error.message);
            });
        }).catch(function(error) {
            console.error('Error uploading image: ' + error.message);
        });
    } else {
        console.error('Please select an image to upload.');
    }
}


function uploadImageAndGetUrl(file) {
    return new Promise((resolve, reject) => {
        var storageRef = storage.ref();
        var imageRef = storageRef.child('new-images/' + file.name);

        imageRef.put(file).then(snapshot => {
            imageRef.getDownloadURL().then(url => {
                resolve(url);
            }).catch(error => {
                reject(error);
            });
        }).catch(error => {
            reject(error);
        });
    });
}

function insertImageIntoDatabase(file) {
    uploadImageAndGetUrl(file)
        .then(url => {
            // Use the URL for database insertion
            console.log('Download URL:', url);
            // Perform database insertion here
        })
        .catch(error => {
            console.error('Error uploading image:', error);
        });
}

// Reference to the Firebase database
var database = firebase.database();

// Reference to your Firebase database path (e.g., 'users')
var dataRef = database.ref("users");

dataRef.on("child_added", function (snapshot) {

	var data = snapshot.val(); 
	var datakey = snapshot.key; 
	console.log(data);
});
// console.log(dataRef);




// Function for insertion
function InsertData() {

	// Get the uploaded image file
	var imageFile = document.getElementById("imageInput").files[0];
	if (!imageFile) {
		alert("Please select an image to upload.");
		return;
	}

	// Upload the image to Firebase Storage
    var storageRef = firebase.storage().ref();
    var imageRef = storageRef.child('newimages/' + imageFile.name);

	imageRef.put(imageFile)
        .then(function(snapshot) {
            // Get the download URL of the uploaded image
            return imageRef.getDownloadURL();
        })
        .then(function(downloadURL) {
            // Once you have the download URL, use it for database insertion
            var nameValue = downloadURL; // Use the image URL
			console.log(nameValue);
            var emailValue = document.getElementById("Emailbox").value;
            var phoneValue = document.getElementById("Pnbox").value;

            var newData = {
                url: nameValue,
                email: emailValue,
                phone: phoneValue,
            };

            // Set method for database insertion
            dataRef.push(newData)
                .then(function() {
                    alert("Data stored successfully.");
                    document.getElementById("url").value = "";
                    document.getElementById("Emailbox").value = "";
                    document.getElementById("Pnbox").value = "";
                });
        })
        .catch(function(error) {
            console.error("Error uploading image: " + error.message);
        });
}

  var insBtn = document.getElementById("Insbtn");
insBtn.addEventListener("click", InsertData);







function openEditModal(data, datakey) {  

	document.getElementById("editName").value = data.name;
	document.getElementById("editEmail").value = data.email;
	document.getElementById("editPhone").value = data.phone;



console.log("see"+datakey);
	document.getElementById("updateBtn").addEventListener("click", function () {
		data.name = document.getElementById("editName").value;
		// console.log("Data" + datakey);

		data.email = document.getElementById("editEmail").value;
		data.phone = document.getElementById("editPhone").value;
 console.log(data.email+data.phone);
		dataRef.child(datakey).update(data)  
			.then(function () {
				alert("Data updated successfully");
			})
			.catch(function (error) {
				alert("Update unsuccessful, " + error);
			});


		console.log("this is key" + datakey);

		window.location.reload();
	});
}




//delete
function deleteData(datakey) {
	dataRef.child(datakey).remove() // using remove function for deleting particular record using its unique key
		.then(function () {
			alert("Data with key " + datakey + " has been deleted.");
			window.location.reload();
		})
		.catch(function (error) {
			console.error("Error deleting data:", error);
		});
}




// Function to fetch and display data
function displayData() {
	var tableBody = document.getElementById("tbody1");



	dataRef.on("child_added", function (snapshot) {

		try {

			var data = snapshot.val(); 
			var datakey = snapshot.key; 
			// console.log(snapshot.key);
			var row = document.createElement("tr");

			// Create table cells for each data field
			// var snoCell = document.createElement("td");
			// var nameCell = document.createElement("td");
			var emailCell = document.createElement("td");
			var phoneCell = document.createElement("td");
			var actionCell = document.createElement("td");

			// snoCell.textContent = data.sno;
			// nameCell.textContent = data.name;
			emailCell.textContent = data.email;
			phoneCell.textContent = data.phone;

			const modalEdit = document.getElementById('editUserModal');

			const editButton = document.createElement('button');
			editButton.innerText = 'Edit';
			editButton.id = 'editBtn';
			editButton.style.backgroundColor = 'green';
			editButton.style.color = 'white';
			editButton.style.width = '55px';
			editButton.style.fontSize = '12px';
			editButton.addEventListener("click", function () {
				//edit modal function call
				openEditModal(data, datakey);

			});


			const deleteButton = document.createElement('button');
			deleteButton.innerText = 'Delete';
			deleteButton.style.backgroundColor = 'red';
			deleteButton.style.color = 'white';
			deleteButton.style.width = '55px';
			deleteButton.style.fontSize = '12px';

			deleteButton.addEventListener("click", function () {
				//delete function call

				deleteData(datakey);

			});

			actionCell.appendChild(editButton);
			actionCell.appendChild(deleteButton);

			// Append cells to the row
			// row.appendChild(snoCell);
			// row.appendChild(nameCell);
			row.appendChild(emailCell);
			row.appendChild(phoneCell);
			row.appendChild(actionCell);

			// Append the row to the table body
			tableBody.appendChild(row);
		}
		catch (error) {
			console.log("Error fetching data:", error);
		}

	});
}

// Call the displayData function to load data into the table
displayData();

</script>
