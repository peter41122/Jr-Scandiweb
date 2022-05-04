<template>
    <div class="row g-3 align-items-center mt-0">
        <label for="exampleFormControlTextarea1" class="form-label"> {{ label }} </label>
        <textarea 
            :errorMessage="errorMessage"
            class="form-control" 
            id="exampleFormControlTextarea1" 
            v-model="content"
            @input="handleInput"
            :rows="rows"
            :cols="cols"
        >
        </textarea>
    </div>
</template>
<script>
export default {
    props: {
        label: String,
        modelValue: String,
        cols: String,
        rows: String,
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