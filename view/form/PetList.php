<div id="content">
    <h2>Pets</h2>
    <table class="table">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Owner's NIF</th>
                <th>Pet Name</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($content as $element) {
                echo "<form method='post' actio=''>";
                echo "<input style='display: none;' type='text' name='id' value={$element->getId()}>";

                echo "<tr>";
                echo "<td>{$element->getId()}</td>";
                echo "<td>{$element->getIdOwner()}</td>";
                echo "<td>{$element->getNames()}</td>";
                echo "<td>";

                echo "<input type='hidden' name='nif' value=" . ($element->getId() ?? '') . ">";
                echo "<input type='submit' name='action' value='form_modify_pet' class='btn btn-primary'>";

                echo "<input type='hidden' name='nif' value=" . ($element->getId() ?? '') . ">";
                echo "<input type='submit' name='action' value='delete_pet' class='btn btn-danger'>";

                echo "</td>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
        </tbody>

    </table>
</div>