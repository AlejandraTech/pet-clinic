<h2>Pet's History</h2>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th>Visit's ID</th>
            <th>ID Pet</th>
            <th>Visit's Date</th>
            <th>Visit's motive</th>
            <th>Visit's description</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($content)) {
            foreach ($content as $element) {
                echo "<tr>";
                echo "<td>{$element->getId()}</td>";
                echo "<td>{$element->getIdPet()}</td>";
                echo "<td>{$element->getDate()}</td>";
                echo "<td>{$element->getMotive()}</td>";
                echo "<td>{$element->getDesc()}</td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>