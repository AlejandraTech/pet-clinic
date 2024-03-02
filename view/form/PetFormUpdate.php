<form method="post" action="">

    <h1>Update Pet</h1>

    <div class="form-group form-inline"> ID *:
        <input contentEditable="false" readonly type="text" placeholder="ID" name="id" value="<?php if (isset($content)) echo $content->getId(); ?>">
    </div>

    <div class="form-group form-inline"> Owner's NIF *:
        <input type="text" placeholder="Owner NIF" name="idowner" value="<?php if (isset($content)) echo $content->getIdOwner(); ?>">
    </div>

    <div class="form-group form-inline"> Name *:
        <input type="text" placeholder="Name" name="name" value="<?php if (isset($content)) echo $content->getNames(); ?>">
    </div>

    <p>* Required fields</p>

    <input class="btn-success mr-2" type="submit" name="action" value="update_pet">
    <input class="btn-danger" type="submit" name="reset" value="reset">

</form>