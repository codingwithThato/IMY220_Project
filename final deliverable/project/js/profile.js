// Add Friend Function using Ajax Promise

// In follow.js

// Add an event listener to handle the button click
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM loaded');
    
    const followButton = document.getElementById('followBtn');
    const unfollowButton = document.getElementById('unfollowBtn');
    const sendButton = document.getElementById('sendMessageBtn');

    if (followButton) {
        followButton.addEventListener('click', function () {
            console.log('Follow button clicked');
            addFriend();
        });
    }

    if (sendButton) {
        sendButton.addEventListener('click', function () {
            sendMessage();
        });
    }
    
    if (unfollowButton) {
        unfollowButton.addEventListener('click', function () {
            unfollowUser();
        });
    }
});

const addFriend = () => {
    const urlParams = new URLSearchParams(window.location.search);// Get the URL parameters
    const recipientId = urlParams.get("user_id");// Get the recipient ID from the URL
    
    const friendRequest = new Promise((resolve, reject) => {
        
        $.ajax({
            url: 'friend_request.php',
            method: 'POST', 
            data: { recipientId: recipientId }, 
            success: (response) => {
                // Request successful
                console.log(response); 
                resolve(response);
            }, 
            error: (error) => {
                // Request failed
                console.error(error); 
                reject(error);
            },
        });
    });

    // Handle the promise
    friendRequest
        .then((response) => {
            // Friend request sent successfully
            const notification = document.getElementById('notification');
            notification.textContent = 'Followed user successfully';
            notification.classList.remove('alert-danger');
            notification.classList.add('alert-success');
            notification.style.display = 'block';

            setTimeout(() => {
                location.reload();
            }, 2000); // Reload after 2 seconds 
        })
        .catch((error) => {
            // Error occurred while sending the friend request
            alert('Error following user');
        });
};


const unfollowUser = () => {
    const url = new URL(window.location.href);
    const userIdToUnfollow = url.searchParams.get("user_id");

    const unfollowRequest = new Promise((resolve, reject) => {
        $.ajax({
            url: 'unfollow_request.php', 
            method: 'POST', 
            data: { userId: userIdToUnfollow }, 
            success: (response) => {
                // Request successful
                console.log(response); 
                resolve(response);
            },
            error: (error) => {
                // Request failed
                console.error(error); 
                reject(error);
            },
        }); 
    });

    // Handle the promise
    unfollowRequest
        .then((response) => {
            const notificationUn = document.getElementById('notificationUn');
            notificationUn.textContent = 'Unfollowed user successfully.';
            notificationUn.classList.add('alert-danger');
            notificationUn.classList.remove('alert-success');
            notificationUn.style.display = 'block';

            // Reload the page after a short delay
            setTimeout(() => {
                location.reload();
            }, 2000); // Reload after 2 seconds (adjust the delay as needed)
        })
        .catch((error) => {
            // Error occurred while sending the unfollow request
            alert('Error unfollowing user');
        });
};

// const updateUIAfterUnfollow = () => {
//     // Update the button text to "Follow" and set its style to "btn-primary"
//     const followBtn = document.getElementById("followBtn"); // Replace with your actual button ID
//     if (followBtn) {
//         followBtn.textContent = "Follow";
//         followBtn.classList.remove("btn-danger"); // Remove any danger class if applied
//         followBtn.classList.add("btn-primary"); // Add the primary class
//     }
// };
