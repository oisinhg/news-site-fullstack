<!-- confirmation box-->
<div id="confirm" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to delete this story?</p>
        <span id="modal-actions">
            <button id="modal-cancel">Cancel</button>
            <form class="story-delete" action="story_delete.php" method="POST">
                <input type="button" id="modal-delete" value="Delete">
            </form>
        </span>
    </div>
</div>