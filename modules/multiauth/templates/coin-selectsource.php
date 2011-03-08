<?php
$this->data['header'] = $this->t('{multiauth:multiauth:select_source_header}');

$this->includeAtTemplateBase('includes/coin-header.php');
?>
	<div class="column content">
		<div class="item">
<span class="h2"><?php echo $this->t('{multiauth:multiauth:select_source_header}'); ?></span>

<p><?php echo $this->t('{multiauth:multiauth:select_source_text}'); ?></p>
<script type="text/javascript">
var gIDP = {
<?php
foreach($this->data['sources'] as $source) {
	if ($source == 'facebook') {
		echo '\'' . $source . '\': {text: \'Login with your <a href="http://www.facebook.com">Facebook</a> account.\', img: \'/resources/logos/facebook-logo.jpg\', url: \'?source=' . htmlspecialchars($source) . '&AuthState=' . htmlspecialchars($this->data['authstate']) . '\'},';
	} else if ($source == 'OpenID') {
                echo '\'' . $source . '\': {text: \'Login with your <a href="http://www.openid.net">OpenID</a> account.\', img: \'/resources/logos/openid-logo.gif\', url: \'?source=' . htmlspecialchars($source) . '&AuthState=' . htmlspecialchars($this->data['authstate']) . '\'},';
        } else if ($source == 'google') {
                echo '\'' . $source . '\': {text: \'Login with your <a href="http://www.google.com">Google</a> account.\', img: \'/resources/logos/google-logo.png\', url: \'?source=' . htmlspecialchars($source) . '&AuthState=' . htmlspecialchars($this->data['authstate']) . '\'},';
        } else if ($source == 'hyves') {
                echo '\'' . $source . '\': {text: \'Login with your <a href="http://www.hyves.nl">Hyves</a> account.\', img: \'/resources/logos/hyves-logo.jpg\', url: \'?source=' . htmlspecialchars(
$source) . '&AuthState=' . htmlspecialchars($this->data['authstate']) . '\'},';
        } else if ($source == 'yahoo') {
                echo '\'' . $source . '\': {text: \'Login with your <a href="http://www.yahoo.com">Yahoo</a> account.\', img: \'/resources/logos/yahoo-logo.png\', url: \'?source=' . htmlspecialchars(
$source) . '&AuthState=' . htmlspecialchars($this->data['authstate']) . '\'},';
        } else if ($source == 'twitter') {
                echo '\'' . $source . '\': {text: \'Login with your <a href="http://www.twitter.com">Twitter</a> account.\', img: \'/resources/logos/twitter-logo.png\', url: \'?source=' . htmlspecialchars($source) . '&AuthState=' . htmlspecialchars($this->data['authstate']) . '\'},';
        } else if ($source == 'SURFguest') {
                echo '\'' . $source . '\': {text: \'Login with your <a href="https://www.surfguest.nl">SURFguest</a> account.\', img: \'/resources/logos/surfnet-logo.jpg\', url: \'?source=' . htmlspecialchars($source) . '&AuthState=' . htmlspecialchars($this->data['authstate']) . '\'},';

        } else {
                echo '\'' . $source . '\': {text: \'Login with your account\', url: \'?source=' . htmlspecialchars($source) . '&AuthState=' . htmlspecialchars($this->data['authstate']) . '\'},';
        }
}
?>
};

function continueLogin() {
        var v = $('#select option:selected').val();
        var location = gIDP[v].url;
        window.location.href = location;
}

function js_select() {
        s = document.getElementById('select');
        t = document.getElementById('text');
        i = document.getElementById('image');
        v = s.options[s.selectedIndex].value;
        if (gIDP[v].text) {
                t.innerHTML = gIDP[v].text;
                t.style.display = '';
        } else {
                t.innerHTML = '';
                t.style.display = 'none'; 
        }       
        if (gIDP[v].img) {
                i.src = gIDP[v].img;
                i.style.display = '';
        } else {
                i.src = '';
                i.style.display = 'none'; 
        }       
}       

$().ready(function() {
        $('#form').submit(function(e) {
                e.preventDefault();
                continueLogin();
        });
});     

</script>
<form method="get" action="" id="form">
<select id="select" name="select" onchange="js_select()">
<?php
foreach($this->data['sources'] as $source) {
        echo '<option value="' . $source . '">' .
                ucwords(htmlspecialchars($source)) . '</option>';
}
?>
</select>
		<p></p>
		<div id="text"></div>
		<p></p>
		<p>
			<input type="submit" name="bsubmit" id="bsubmit" value="Confirm" />

		</p>


		<p>
		<input type="image" id="image" src="" alt="" style="border-style: none" />
		</p>
		
		</form>
		<script type="text/javascript">
			window.onload = js_select;
		</script>

		</div>
	</div>


<?php $this->includeAtTemplateBase('includes/coin-footer.php'); ?>
