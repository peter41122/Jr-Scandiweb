<template>
    <div>
        <div class="d-flex justify-content-between">
            <h3> Product Add </h3>

            <div>
                <button class="btn btn-outline-dark btn-sm rounded-lg mx-1" @click="add"> Save </button>
                <button class="btn btn-outline-dark btn-sm rounded-lg mx-1" @click="cancel">
                    <router-link class="text-decoration-none text-dark router-link" to="/">Cancel</router-link>
                </button>
            </div>
        </div>
        <hr class="my-3" />
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-12 mb-4">
                        <g-input
                            label="SKU"
                            errorMessage="Please, submit required data, `SKU`"
                            v-model="formData.sku"
                            ref="ref_sku"
                        />
                    </div>
                    <div class="col-12 mb-4">
                        <g-input
                            ref="ref_name"
                            label="Name"
                            errorMessage="Please, submit required data, `Name`"
                            v-model="formData.name"
                        />
                    </div>
                    <div class="col-12 mb-4">
                        <g-input
                            ref="ref_price"
                            label="Price ($)"
                            errorMessage="Please, submit required data, `Price`"
                            v-model="formData.price"
                        />
                    </div>
                    <div class="col-12 mb-4">
                        <g-select
                            ref="ref_type"
                            label="Type Switcher"
                            errorMessage="Please, submit required data, `Type Switcher`"
                            :options="types"
                            v-model="formData.type"
                            @change="formData.type_value = {}"
                        />
                    </div>
                </div>

                <!-- #DVD -->
                <div class="col-6 mb-4 w-100" v-if="formData.type == 1">
                    <div class=""> #DVD </div>
                    <g-input
                        ref="ref_size"
                        errorMessage="Please,provide the data of `Size`"
                        label="Size (MB)"
                        v-model="formData.type_value.size"
                    />
                    <g-textarea
                        ref="ref_description"
                        errorMessage="Please,provide the data of `Product Description`"
                        label="Product Description"
                        v-model="formData.type_value.description"
                        rows="5"
                        cols="5"
                    />
                </div>

                <!-- #Furniture -->
                <div class="col-6 mb-4 w-100" v-if="formData.type == 2">
                    <div class=""> #Furniture </div>
                    <g-input
                        ref="ref_height"
                        errorMessage="Please,provide the data of `Height`"
                        label="Height (CM)"
                        v-model="formData.type_value.height"
                    />
                    <g-input
                        ref="ref_width"
                        errorMessage="Please,provide the data of `Width`"
                        label="Width (CM)"
                        v-model="formData.type_value.width"
                    />
                    <g-input
                        ref="ref_lenght"
                        errorMessage="Please,provide the data of `Lenght`"
                        label="Lenght (CM)"
                        v-model="formData.type_value.lenght"
                    />
                    <g-textarea
                        ref="ref_description"
                        errorMessage="Please,provide the data of `Product Description`"
                        label="Product Description"
                        v-model="formData.type_value.description"
                        rows="5"
                        cols="5"
                    />
                </div>

                <!-- #Book -->
                <div class="col-6 mb-4 w-100" v-if="formData.type == 3">
                    <div class=""> #Book </div>
                    <g-input
                        ref="ref_weight"
                        errorMessage="Please,provide the data of `Weight`"
                        label="Weight (KG)"
                        v-model="formData.type_value.weight"
                    />
                    <g-textarea
                        ref="ref_description"
                        errorMessage="Please,provide the data of `Product Description`"
                        label="Product Description"
                        v-model="formData.type_value.description"
                        rows="5"
                        cols="5"
                    />
                </div>


            </div>
        </div>
    </div>
</template>
<script>
import GInput from '../components/GInput.vue'
import GSelect from '../components/GSelect.vue'
import GTextarea from '../components/GTextarea.vue'
import axios from "axios";
import Izitoast from "izitoast";
import "izitoast/dist/css/iziToast.min.css";

export default {
  components: { GInput, GSelect, GTextarea },
    data() {
        return {
            types: [
                { value: 1, name: "#DVD" },
                { value: 2, name: "#Furniture" },
                { value: 3, name: "#Book" }
            ],
            formData: {
                sku: null,
                name: null,
                price: null,
                type: null,
                type_value: {}
            },
        }
    },
    methods: {
        test() {

        },
        add() {
            if ( this.validation() ) {
                axios.post("/products", this.formData)
                    .then( (res) => {
                        this.$router.push({ name: "Home" });
                    })
            }
        },
        validation() {
            //TODO can use vee validate
            if ( this.checkFormData() && this.checkTypeValue() )
                    return true;
            return false;
        },
        checkFormData() {
            let ref = [ "sku", "name", "price", "type" ],
                check = false;
            ref.every( (_value) => {
                let r = this.$refs[`ref_${_value}`]._;
                if ( !r.props.modelValue ) {
                    this.toast('error', r.props.errorMessage, 'Error!!' );
                    check = false;
                    return false;
                } else {
                    check = true;
                    return true;
                }
            });
            return check;
        },
        checkTypeValue() {
            let typeRef = {
                    1: [ "size", "description"],
                    2: [ "height", "width", "lenght", "description"],
                    3: [ "weight", "description"]
            },
            check = false;
            typeRef[this.formData.type].every( (_value) => {
                let r = this.$refs[`ref_${_value}`]._;
                if ( !r.props.modelValue ) {
                    this.toast('error', r.props.errorMessage, 'Error!!' );
                    check = false
                    return false;
                } else {
                    check = true;
                    return true;
                }
            });
            return check;
        },
        toast(_type, _message, _title ) {
            return Izitoast[_type]({
                title: _title,
                message: _message
            });
        }
    }
}
</script>