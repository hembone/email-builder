$(function() {



});

function confirmBox(text) {
	if(typeof text === 'undefined') {
		var text = 'Are you sure you want to do that?';
	}
	return confirm(text);
}