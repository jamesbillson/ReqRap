
<h4>Approver's comments</h4>
 <div class="row offset1">
<form action="/walkthrupath/run/" method="POST" name="Walkthruresult">
	 <div class="row">
	 <select name="result">
        <?php foreach (Walkthruresult::$result as $key=>$result) { ?>
            <option value="<?php echo $key; ?>"><?php echo $result; ?></option>
        <?php } ?>
        </select>
	</div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="row">
            <input type="text" name="comments">
	</div>

	<div class="row buttons">
            <input type="submit" value="Comment">
    </div>
</form>
</div>



