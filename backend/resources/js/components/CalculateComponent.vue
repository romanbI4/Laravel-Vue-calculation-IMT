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
                <h2 v-if="imt">
                    <p>
                        Ваш ИМТ: {{ imt }}
                    </p>
                    <p align="center">
                        Интерпретация индекса массы тела
                    </p>
                    <div class="align-content-center" v-if="imt">
                        <p v-if="imt < 18.5" class="bg-success">
                            Ниже нормального веса
                        </p>
                        <p v-if="imt >= 18.5 && imt < 25" class="bg-success">
                            Нормальный вес
                        </p>
                        <p v-if="imt >= 25 && imt < 30" class="bg-success">
                            Избыточный вес
                        </p>
                        <p v-if="imt >= 30 && imt < 35" class="bg-success">
                            Ожирение I степени
                        </p>
                        <p v-if="imt >= 35 && imt < 40" class="bg-success">
                            Ожирение II степени
                        </p>
                        <p v-if="imt > 40" class="bg-success">
                            Ожирение III степени
                        </p>
                    </div>
                </h2>
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
