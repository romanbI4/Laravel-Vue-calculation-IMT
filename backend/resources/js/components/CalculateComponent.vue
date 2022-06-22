<template>
    <div>
        <h2 align="center">
            Расчет ИМТ человека
        </h2>
        <div class="form-group">
            <label for="height">Ваш рост</label>
            <input type="number" class="form-control" id="height" placeholder="рост в м" step="0.01"
                   v-model="form.height">
        </div>
        <div class="form-group">
            <label for="weight">Ваш вес</label>
            <input type="number" class="form-control" id="weight" placeholder="вес в кг" step="0.01"
                   v-model="form.weight">
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <input type="submit" class="btn btn-success" v-on:click="calculate()" value="Расчет!">
                <h3>
                    <p v-if="imt">
                        Ваш ИМТ: {{ imt }}
                    </p>
                </h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            imt: null,
            form: {
                weight: '',
                height: ''
            }
        }
    },
    methods: {
        calculate() {
            if (confirm("Do you really want to calculate it?")) {
                axios.post('/calculations', this.form)
                    .then(response => {
                        this.imt = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
}
</script>
