<html lang="en">
<head>
    <link rel="stylesheet" href="index.css">
    <title>Table</title>
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body>

<div x-data="loadData()">

        <div>
            <label>
                <input type="text" name="name" x-model="inputfield" required :placeholder="placeholder">
            </label>
        </div><br>
        <button class="mbutton" @click="submit()">Submit</button>

    <template x-if="filteredData!=null" x-cloak>
        <table style="width: 20%">
            <template x-for="item in Object.values(filteredData)" :key="item.id">
                <tr>
                    <td x-text="item.name" style="font-family: Arial, 'serif"></td>
                    <td style="width: 10%">
                        <button class="mbutton" @click="pop = item">Remove</button>
                    </td>
                </tr>
            </template>
        </table>
    </template>
    <?php
    include("dialog.php")
    ?>
    <center style="font-family: Arial,serif;">
        <div x-cloak>
            Search name: <br>
            <label>
                <input placeholder="Search" type="text" x-on:input="filterEvent($event)" x-model="filter">
            </label>
        </div>
    </center>

</div>
<script>
    function loadData() {
        return {
            pop:null,
            filter: "",
            data: null,
            filteredData: null,
            placeholder: 'Naam',
            inputfield: "",
            init() {
                this.fetchData()
            },
            submit() {
                fetch('create/' + this.inputfield)
                    .then(response => response.json())
                    .then(data => {
                        this.data = data;
                        this.doFilter();
                    });
            },
            fetchData() {

                fetch('read')
                    .then(response => response.json())
                    .then(data => {
                        this.data = data;
                        this.doFilter()
                    });
            },
            filterEvent(){
               this.doFilter()
            },
            del(id){
                console.log("hallo")
                this.pop=null;
             fetch ('delete/'+id)
                    .then(response => response.json())
                    .then(data => {
                        this.data = data;
                        this.doFilter()
                    });
            },
            doFilter(){
                this.filteredData = this.filter === "" ? this.data: this.data.filter((item) =>item.name.toUpperCase().indexOf(this.filter.toUpperCase()) !== -1)
            }
        }
    }
</script>
</body>
</html>
