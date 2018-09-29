<script type="text/javascript">
	function getHighScorers(callback) {
		var highScorers=[];
		var highScore=0;
		var selector=_total_selector;
		selector.each(function(k,v) {
			var score=Number($(v).html());
			if (k==0) {
				highScorers.push(k);
			}else{
				if (score > highScore) {
					highScore=score;
					highScorers=[];
					highScorers.push(k);
				}else if (score == highScore) {
					highScorers.push(k);
				}
			}
		});
		
		callback(highScorers);
	}
	
	function setGoldenCells(highscorers) {
		var total_selector=_total_selector;
		var user_selector=_user_selector;
		total_selector.each(function(k,sel) {
			if (highscorers.indexOf(k) != -1) {
				$(sel).addClass("golden");
				$(user_selector[k]).addClass("golden");
			}
		});
	}
	
	var _total_selector=$(".total-cell");
	var _user_selector=$(".user-cell");
	
	$(function() {
		getHighScorers(function(highscorers) {
			setGoldenCells(highscorers);
		});		
	});
	
</script>
