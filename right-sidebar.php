<!-- <div class="right_sidebar"style="background:rgba(230, 236, 240, 0.5);">
            <div class="search-container" >
                <a href="" class="search-btn">
                    <i class="fa fa-search"></i>
                </a>
                <input type="text" name="search" placeholder="search" class="search-input search" autocomplete="off">
            </div>
            <div class='search-result'>
            </div>
            
             -->


<style>
    .right_sidebar::-webkit-scrollbar {
        width: 8px;
    }

    .right_sidebar::-webkit-scrollbar-track {
        background: rgba(230, 236, 240, 0.5);
    }

    .right_sidebar::-webkit-scrollbar-thumb {
        background: rgba(230, 236, 240, 0.5);
        border-radius: 4px;
    }

    .right_sidebar::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<div class="right_sidebar" style="background:rgba(230, 236, 240, 0.5); overflow-y: auto;">
    <div class="search-container">
        <a href="" class="search-btn">
            <i class="fa fa-search"></i>
        </a>
        <input type="text" name="search" placeholder="search" class="search-input search" autocomplete="off">
    </div>
    <div class='search-result'>
    </div>

    <?php $getFromT->trends(); ?>

    <?php $getFromF->whoToFollow($user_id, $user_id); ?>
</div>