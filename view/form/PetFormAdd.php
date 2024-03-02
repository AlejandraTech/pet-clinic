<form method="post" action="">

    <h1>Add Pet</h1>

    <div class="form-group form-inline"> Owner's NIF *:
        <input type="text" placeholder="NIF" name="idOwner" value="<?php if (isset($content)) echo $content->getIdOwner(); ?>">
    </div>

    <div class="form-group form-inline"> Name *:
        <input type="text" placeholder="Name" name="name" value="<?php if (isset($content)) echo $content->getNames(); ?>">
    </div>

    <p>* Required fields</p>

    <input class="btn-success mr-2" type="submit" name="action" value="add_pet">
    <input class="btn-danger" type="submit" name="reset" value="reset">

</form>