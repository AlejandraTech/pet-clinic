<div id="content" class="table-responsive">
    <table class="table">

        <thead class="thead-light">
            <tr>
                <th>Nif</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($content as $element) {

                echo "<tr>";
                echo "<td>{$element->getNif()}</td>";
                echo "<td>{$element->getName()}</td>";
                echo "<td>{$element->getEmail()}</td>";
                echo "<td>{$element->getPhone()}</td>";
                echo "<td>";

                echo "<form method='post' action='' style='display:inline;'>";
                echo "<input type='hidden' name='nif' value=" . ($element->getNif() ?? '') . ">";
                echo "<input type='submit' name='action' value='form_find_owner_to_update' class='btn btn-primary'>";
                echo "</form>";

                echo "<form method='post' action='' style='display:inline;'>";
                echo "<input type='hidden' name='nif' value=" . ($element->getNif() ?? '') . ">";
                echo "<input type='submit' name='action' value='delete_owner' class='btn btn-danger'>";
                echo "</form>";

                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>

    </table>
</div>