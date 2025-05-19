<div class="pc-container">
    <div class="pc-content">
        <h1>Add Service Category</h1>

        <form action="" method="POST">
            <div class="form-group">
                <label for="CategoryName">Category Name</label>
                <input type="text" class="form-control" id="CategoryName" name="CategoryName" required>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="parent_id">Parent Category</label>
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="">None</option>
                    <?php if (!empty($parentcategories)): ?>
                        <?php foreach ($parentcategories as $parentcategory): ?>
                            <option value="<?php echo htmlspecialchars($parentcategory['CategoryID']); ?>"><?php echo htmlspecialchars($parentcategory['CategoryName']); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            <a href="<?php echo _WEB_ROOT; ?>/servicecategory" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
