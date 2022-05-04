<template>
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">{{ label }}</label>
        </div>
        <div class="col-auto">
            <select
                :errorMessage="errorMessage"
                v-model="content" 
                @change="$emit('update:modelValue', $event.target.value)" 
                class="form-select" 
                aria-label="Default select example"
            >
                <option disabled value="">Please select one</option>
                <option v-for="(index,key) in options" :key="key" :value="index.value">
                    {{ index.name }}
                </option>
            </select>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        label: String,
        modelValue: String,
        options: Array,
        errorMessage: String,
    },
    watch: {
        modelValue: function(_value) {
            this.content = _value;
        }
    },
    data() {
        return {
            content: "",
        }
    },
    methods: {
        handleInput() {
            this.$emit("update:modelValue", this.content);
            this.$emit("change", this.content);
        },
    }
}
</script>