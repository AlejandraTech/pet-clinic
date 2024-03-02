<form method="post" action="">

    <h1>Insert History</h1>

    <div class="form-group form-inline"> ID of pet *:
        <input type="text" placeholder="ID of pet" name="idpet" value="<?php if (isset($content)) echo $content->getIdPet(); ?>">
    </div>

    <div class="form-group form-inline"> Visit Date * (YYYY-MM-DD):
        <input type="text" placeholder="YYYY-MM-DD" name="date" value="<?php if (isset($content)) echo $content->getDate(); ?>">
    </div>
    
    <div class="form-group form-inline"> Motive:
        <input type="text" placeholder="Motive" name="motive" value="<?php if (isset($content)) echo $content->getMotive(); ?>">
    </div>
    
    <div class="form-group form-inline"> Description:
        <input type="text" placeholder="Description" name="desc" value="<?php if (isset($content)) echo $content->getDesc(); ?>">
    </div>

    <p>* Required fields</p>

    <input class="btn-success mr-2" type="submit" name="action" value="add_history">
    <input class="btn-danger" type="submit" name="reset" value="reset">

</form>