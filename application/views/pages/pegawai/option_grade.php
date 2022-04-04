<?php foreach ($grade as $data) : ?>
    <option value="<?= $data->id ?>"><?= $data->title; ?></option>
<?php endforeach ?>