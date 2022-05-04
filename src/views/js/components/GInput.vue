<template>
    <div class="row my-1">
        <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">{{ label }}</label>
        </div>
        <div class="col-auto w-100">
            <input 
                :errorMessage="errorMessage"
                type="text" 
                class="form-control" 
                aria-label="Small" 
                aria-describedby="inputGroup-sizing-sm"
                v-model="content"
                @input="handleInput"
            >
        </div>
    </div>
</template>
<script>
export default {
    props: {
        label: String,
        modelValue: String,
        errorMessage: String,
    },
    data() {
        return {
            content: "",
        }
    },
    watch: {
        modelValue: function(_value) {
            this.content = _value;
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