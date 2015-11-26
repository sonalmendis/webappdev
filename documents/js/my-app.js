// Initialize your app
var myApp = new Framework7();

// Export selectors engine
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: true

});


// Callbacks to run specific code for specific pages, for example for About page:
myApp.onPageInit('about', function (page) {
    // run createContentPage func after link was clicked
    $$('.create-page').on('click', function () {
        createContentPage();
    });
});

// Generate dynamic page
var dynamicPageIndex = 0;
function createContentPage() {
	mainView.router.loadContent(
        '<!-- Top Navbar-->' +
        '<div class="navbar">' +
        '  <div class="navbar-inner">' +
        '    <div class="left"><a href="#" class="back link"><i class="icon icon-back"></i><span>Back</span></a></div>' +
        '    <div class="center sliding">Dynamic Page ' + (++dynamicPageIndex) + '</div>' +
        '  </div>' +
        '</div>' +
        '<div class="pages">' +
        '  <!-- Page, data-page contains page name-->' +
        '  <div data-page="dynamic-pages" class="page">' +
        '    <!-- Scrollable page content-->' +
        '    <div class="page-content">' +
        '      <div class="content-block">' +
        '        <div class="content-block-inner">' +
        '          <p>Here is a dynamic page created on ' + new Date() + ' !</p>' +
        '          <p>Go <a href="#" class="back">back</a> or go to <a href="services.html">Services</a>.</p>' +
        '        </div>' +
        '      </div>' +
        '    </div>' +
        '  </div>' +
        '</div>'
    );
	return;
}


// Now we need to run the code that will be executed only for About page.
 
$('a#feed-back-form-link').click(function (){
$( "div#feedback-form" ).slideToggle( "fast" );
})


//Calling app on more-info page

myApp.onPageInit('more-info', function (page) {

mixpanel.track("More information");

})

myApp.onPageInit('influencer-chat-records', function (page) {
mainView.router.refreshPage();
mainView.router.refreshPreviousPage();
mixpanel.track("Chat records");

})







// Calling app on feed-chat page
myApp.onPageInit('feed-chat', function (page) {

var feedid = document.getElementById('brandid');
var neededData = feedid.innerHTML;

$('.message-textarea').keypress(function (e) {
  if (e.which == 13) {
if(form1.msg.value == '') {
alert('Enter a message!');
return;
}

var premsg = form1.msg.value;
var msg = premsg.replace(/'/g, "''");
var xmlhttp = new XMLHttpRequest();
	
xmlhttp.onreadystatechange = function(){
if(xmlhttp.readyState==4&&xmlhttp.status==200) {
document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
}
}


xmlhttp.open('GET','../insert.php?brandid='+neededData+'&msg='+msg, true);
xmlhttp.send();


/* $(".message-textarea").val('');
setTimeout(function(){
$('.page-content').animate({ scrollTop: $('.messages-content').height()}, 1);
}, 200); */

    return false;    //<---- Add this line
  }
  /*
  	$( "#some_id" ).click(function() {
		clearInterval(refreshIntervalId);
		neededData = null;
	}); */
  
});


$(document).ready(function(e) {


	$.ajaxSetup({cache:false});
	$('#chatlogs').load('../logs.php?brandid='+neededData, function() {
		$('.page-content').animate({ scrollTop: $('.messages-content').height()}, 1);
	}); 
	var refreshIntervalId = setInterval(function() {$('#chatlogs').load('../logs.php?brandid='+neededData)}, 3000);
	
	$( "#some_id" ).click(function() {
		clearInterval(refreshIntervalId);
		neededData = null;
	});


});

});













myApp.onPageInit('messages', function (page) {
    var conversationStarted = false;
    var answers = [
        'Yes!',
        'No',
        'Hm...',
        'I am not sure',
        'And what about you?',
        'May be ;)',
        'Lorem ipsum dolor sit amet, consectetur',
        'What?',
        'Are you sure?',
        'Of course',
        'Need to think about it',
        'Amazing!!!',
    ];
    var people = [
        {
            name: 'Kate Johnson',
            avatar: 'http://lorempixel.com/output/people-q-c-100-100-9.jpg'
        },
        {
            name: 'Blue Ninja',
            avatar: 'http://lorempixel.com/output/people-q-c-100-100-7.jpg'
        },
        
    ];
    var answerTimeout, isFocused;

    // Initialize Messages
    var myMessages = myApp.messages('.messages');

    // Initialize Messagebar
    var myMessagebar = myApp.messagebar('.messagebar');
    
    $$('.messagebar a.send-message').on('touchstart mousedown', function () {
        isFocused = document.activeElement && document.activeElement === myMessagebar.textarea[0];
    });
    $$('.messagebar a.send-message').on('click', function (e) {
        // Keep focused messagebar's textarea if it was in focus before
        if (isFocused) {
            e.preventDefault();
            myMessagebar.textarea[0].focus();
        }
        var messageText = myMessagebar.value();
        if (messageText.length === 0) {
            return;
        }
        // Clear messagebar
        myMessagebar.clear();

        // Add Message
        myMessages.addMessage({
            text: messageText,
            type: 'sent',
            day: !conversationStarted ? 'Today' : false,
            time: !conversationStarted ? (new Date()).getHours() + ':' + (new Date()).getMinutes() : false
        });
        conversationStarted = true;
        // Add answer after timeout
        if (answerTimeout) clearTimeout(answerTimeout);
        answerTimeout = setTimeout(function () {
            var answerText = answers[Math.floor(Math.random() * answers.length)];
            var person = people[Math.floor(Math.random() * people.length)];
            myMessages.addMessage({
                text: answers[Math.floor(Math.random() * answers.length)],
                type: 'received',
                name: person.name,
                avatar: person.avatar
            });
        }, 2000);
    }); 
	
});

