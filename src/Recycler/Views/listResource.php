<?php $this->extend('master') ?>

<?php $this->section('main') ?>

<x-page-head>
    <div class="row">
        <div class="col">
            <h2><?= lang('Recycler.recyclerModTitle') ?></h2>
        </div>
        <?php if (count($resources) > 1) : ?>
            <div class="col-auto">
            <select name="r" class="form-select" x-on:change="sendRecyclerGetRequest($event.target.value)"
            >
                <?php foreach ($resources as $alias => $details) : ?>
                    <option value="<?= strtolower($alias) ?>" <?= (strtolower($currentAlias) === strtolower($alias)) ? 'selected' : ''?>><?= $details['label'] ?></option>
                <?php endforeach ?>
                </select>
            </div>
        <?php endif ?>
    </div>
</x-page-head>

<x-admin-box>

    <fieldset id="resource">
        <legend><?= $currentResource['label'] ?></legend>

        <?php if (isset($items) && count($items)) : ?>
            <p><?=lang('Recycler.resultLabel', [$pager->getTotal()])?></p>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                    <?php foreach ($currentResource['localizedColumns'] as $column) : ?>
                        <th><?= esc(ucwords(str_replace('_', ' ', $column))) ?></th>
                    <?php endforeach ?>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                            <?php foreach ($currentResource['columns'] as $column) : ?>
                                <td><?= esc($item[$column] ?? '') ?></td>
                            <?php endforeach ?>
                                <td class="text-end">
                                    <div class="btn-group">
                                            <a href="<?= url_to('recycler-restore', $currentAlias, $item['id']) ?>"
                                        class="text-success" title="<?= lang('Recycler.restoreMsgTitle') ?>"
                                        onclick="return confirm('<?= lang('Recycler.restoreMsgContent') ?>');"
                                            >
                                                <i class="fas fa-trash-restore"></i>
                                            </a>
                                            &nbsp;
                                            <a href="<?= url_to('recycler-purge', $currentAlias, $item['id']) ?>"
                                        class="text-danger" title="<?= lang('Recycler.purgeMsgTitle') ?>"
                                        onclick="return confirm('<?= lang('Recycler.purgeMsgContent') ?>');"
                                            >
                                                <i class="fas fa-minus-circle"></i>
                                            </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="alert alert-info">
            <?= lang('Recycler.notFound', [$currentAlias]) ?>
            </div>
        <?php endif ?>

    </fieldset>

</x-admin-box>

<?php $this->endSection() ?>
