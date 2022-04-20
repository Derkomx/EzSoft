<html>
<head>

</head>
<body>
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">Productos</h4>
        </div>
        <div class="card-body">
            <div>
                <div class="btn-group w-100 mb-2">
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="all"> All items </a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="1"> Category 1 (WHITE) </a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="2"> Category 2 (BLACK) </a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="3"> Category 3 (COLORED) </a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> Category 4 (COLORED, BLACK) </a>
                </div>
                <div class="mb-2">
                    <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle=""> Shuffle items </a>
                    <div class="float-right">
                        <select class="custom-select" style="width: auto;" data-sortorder="">
                            <option value="index"> Sort by Position </option>
                            <option value="sortData"> Sort by Custom Data </option>
                        </select>
                        <div class="btn-group">
                            <a class="btn btn-default" href="javascript:void(0)" data-sortasc=""> Ascending </a>
                            <a class="btn btn-default" href="javascript:void(0)" data-sortdesc=""> Descending </a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="filter-container p-0 row"
                    style="padding: 3px; position: relative; width: 100%; display: flex; flex-wrap: wrap; height: 211px;">
                    <!-- aca hay que crear en bucle con la bd -->
                    <div class="filtr-item col-sm-2" data-category="1" data-sort=""
                        style="opacity: 1; transform: scale(1) translate3d(444px, 0px, 0px); backface-visibility: hidden; perspective: 1000px; transform-style: preserve-3d; position: absolute; width: 108.4px; transition: all 0.5s ease-out 0ms, width 1ms ease 0s;">
                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox"
                            data-title="sample 1 - white">
                            <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2"
                                alt="white sample">
                        </a>
                    </div>
                    <!-- hasta aca   -->
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>