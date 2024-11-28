<div class="banner d-flex justify-content-center align-items-center">
    <div class="formDiv w-25">
        <form id="voteForm">
            <input type="hidden" id="currentUserId" value="<?php echo $_SESSION['id']; ?>">

            <div class="mb-3">
                <label for="employee" class="form-label h5">Employee</label>
                <select class="form-select" aria-label="Default select example" id="employee" name="employee">
                    <option selected disabled>Pick an employee</option>
                </select>

            </div>
            <div class="mb-3">
                <label for="category" class="form-label h5">Category</label>
                <select class="form-select" aria-label="Default select example" id="category" name="category">
                    <option selected disabled>Pick a category</option>
                </select>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="comment" required name="comment"> </textarea>
                <label class="form-label h5" for="comment">Comment</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>