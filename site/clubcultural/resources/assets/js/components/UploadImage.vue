<template>
    <div>
        <div class="file-upload-form">
            <input type="file" @change="previewImage" name="image" accept="image/*" class="form-control">
        </div>
        <div class="image-preview" v-if="imageData.length > 0">
            <img class="preview" :src="imageData">
        </div>
    </div>
</template>

<script>
    export default {
        props:['model', 'name', 'url'],

        data() {
            return {
                imageData: this.url ? this.url : ''  // we will store base64 format of image in this string
            }
        },

        methods: {
            previewImage: function(event) {
                // Reference to the DOM input element
                var input = event.target;
                console.log(input);
                console.log(input.files);
                // Ensure that you have a file before attempting to read it
                if (input.files && input.files[0]) {
                    // create a new FileReader to read this image and convert to base64 format
                    var reader = new FileReader();
                    // Define a callback function to run, when FileReader finishes its job
                    reader.onload = (e) => {
                        // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                        // Read image as base64 and set to imageData
                        this.imageData = e.target.result;
                        console.log(e);
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    }
</script>

<style lang="css" scoped>
    .file-upload-form, .image-preview {
        padding-bottom: 20px;
    }

    img.preview {
        width: 200px;
        background-color: white;
        border: 1px solid #DDD;
        padding: 5px;
    }

</style>