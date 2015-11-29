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


/* The following function is concerned with sending/addding a chat message to insert.php which then is processed in logs.php and added to the database */
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


/* The commented out script below is to try and get the screen to move up once a user enters a message */
/* $(".message-textarea").val('');
setTimeout(function(){
$('.page-content').animate({ scrollTop: $('.messages-content').height()}, 1);
}, 200); */

    return false;    //<---- Add this line
  }

  
});



/* The following function is concerned with loading the message logs (chat history) for that specific chat via logs.php */
$(document).ready(function(e) {

	$.ajaxSetup({cache:false});
	$('#chatlogs').load('../logs.php?brandid='+neededData, function() {
		$('.page-content').animate({ scrollTop: $('.messages-content').height()}, 1);
	}); 
	
	/* Rechecks the logs every 3 seconds for any new messages i.e realtime updating */
	var refreshIntervalId = setInterval(function() {$('#chatlogs').load('../logs.php?brandid='+neededData)}, 3000);
	
	
	/* The following clears the variable 'neededData' when to prevent it being kept,
	otherwise when this script runs again (when you open another chat with someone else) it would try loading
	both logs and flicker between the two */

	$( "#back-btn-from-chat" ).click(function() {
		clearInterval(refreshIntervalId);
		neededData = null;
	});


});

});





