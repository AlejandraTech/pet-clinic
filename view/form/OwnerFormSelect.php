<form method="post" action="">

    <h1>Find Owner to Update</h1>

    <div class="form-group form-inline"> NIF *:
        <input type="text" placeholder="NIF" name="nif" value="<?php if (isset($content)) echo $content->getNif(); ?>">
    </div>

    <p>* Required fields</p>

    <input class="btn-success mr-2" type="submit" name="action" value="find_owner_to_update">
    <input class="btn-danger" type="submit" name="reset" value="reset">

</form>