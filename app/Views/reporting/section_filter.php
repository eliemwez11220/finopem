<form role="form" id="ajax_form_sections" method="get">
    <div class="form-floating input-group" style="width: 100%!important;">
        <select id="ajax_sections" name="ajax_sections" title="Classe" class="form-control select2 select2-info"
            data-dropdown-css-class="select2-info">
            <option disabled selected>--sélectionnez une section--</option>
            <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                <option value="all">Toutes les sections</option>
            <?php endif; ?>
            <?php
            $sections_listing = [];
            if (session()->has('usersbranchs')) {
                if (session()->get('usersbranchs') == 'none') {
                    $sparents_listing = [];
                } else {
                    $sections_listing = session()->usersbranchs;
                }
            } else {
                if (isset($sections)) {
                    $sections_listing = $sections;
                }
            }

            if ((!empty($sections_listing))):
                foreach ($sections_listing as $key => $value):
                    if (session()->has('usersbranchs') or (session()->admin == TRUE) or (session()->all == TRUE) ):
                        ?>
                        <option value="<?= trim($value['section_id']); ?>" <?= (session()->has('choosedsectionid') && (session()->choosedsectionid == $value['section_id'])) ? 'selected' : set_select('ajax_sections', trim($value['section_id'])); ?>>
                            <?= strtoupper(trim($value['section_name'])); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <label for="ajax_sections">
            <span class="text-danger">*</span>Sections organisées</label>
    </div>
</form>