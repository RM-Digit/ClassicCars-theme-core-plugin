<?php
/* @var \Vehica\Search\Field\DateSearchField $vehicaSearchField */
global $vehicaSearchField;
?>
<div class="vehica-search__field vehica-relation-field <?php echo esc_attr($vehicaSearchField->getClass()); ?>">
    <vehica-date-search-field
            :date-field="<?php echo htmlspecialchars(json_encode($vehicaSearchField)); ?>"
            :filters="searchFormProps.filters"
            field-key="<?php echo esc_attr(vehicaApp('from_rewrite')); ?>"
            time-format="<?php echo esc_attr(\Vehica\Model\Post\Field\DateTimeField::getTimeFormat()); ?>"
            date-format="<?php echo esc_attr(\Vehica\Model\Post\Field\DateTimeField::getDateFormat()); ?>"
            :start-of-week="<?php echo esc_attr(\Vehica\Model\Post\Field\DateTimeField::getStartOfWeek()); ?>"
            :strings="<?php echo htmlspecialchars(json_encode(\Vehica\Model\Post\Field\DateTimeField::getStrings())); ?>"
            from-rewrite="<?php echo esc_attr(vehicaApp('from_rewrite')); ?>"
            to-rewrite="<?php echo esc_attr(vehicaApp('to_rewrite')); ?>"
    >
        <div class="yearFrom"><?php echo esc_attr($vehicaSearchField->getPlaceholderFrom()); ?></div>
        <div
                slot-scope="dateField"
                class="vehica-text-field"
                :class="{'vehica-text-field-active': dateField.value !== ''}"
        >
            <template>
                    <span
                            v-if="dateField.value !== ''"
                            class="vehica-form-button__clear vehica-form-button__clear--text"
                            @click.prevent="dateField.clearSelection"
                    >
                        <i class="fas fa-times"></i>
                    </span>
            </template>
            <input
                    class="vehica-date-picker"
                    placeholder="<?php echo esc_attr($vehicaSearchField->getPlaceholderFrom()); ?>"
                    type="text"
            >
        </div>
    </vehica-date-search-field>
</div>

<div class="vehica-search__field vehica-relation-field <?php echo esc_attr($vehicaSearchField->getClass()); ?>">
    <vehica-date-search-field
            :date-field="<?php echo htmlspecialchars(json_encode($vehicaSearchField)); ?>"
            :filters="searchFormProps.filters"
            field-key="<?php echo esc_attr(vehicaApp('to_rewrite')); ?>"
            time-format="<?php echo esc_attr(\Vehica\Model\Post\Field\DateTimeField::getTimeFormat()); ?>"
            date-format="<?php echo esc_attr(\Vehica\Model\Post\Field\DateTimeField::getDateFormat()); ?>"
            :start-of-week="<?php echo esc_attr(\Vehica\Model\Post\Field\DateTimeField::getStartOfWeek()); ?>"
            :strings="<?php echo htmlspecialchars(json_encode(\Vehica\Model\Post\Field\DateTimeField::getStrings())); ?>"
            from-rewrite="<?php echo esc_attr(vehicaApp('from_rewrite')); ?>"
            to-rewrite="<?php echo esc_attr(vehicaApp('to_rewrite')); ?>"
    >
        <div class="yearTo"></div>
        <div
                slot-scope="dateField"
                class="vehica-text-field"
                :class="{'vehica-text-field-active': dateField.value !== ''}"
        >
            
            <template>
                    <span
                            v-if="dateField.value !== ''"
                            class="vehica-form-button__clear vehica-form-button__clear--text"
                            @click.prevent="dateField.clearSelection"
                    >
                        <i class="fas fa-times"></i>
                    </span>
            </template>
            <input
                    class="vehica-date-picker"
                    placeholder="<?php echo esc_attr($vehicaSearchField->getPlaceholderTo()); ?>"
                    type="text"
            >
        </div>
    </vehica-date-search-field>
</div>
