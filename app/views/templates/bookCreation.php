<div class="book-creation">
    <h2 class="book-creation__title">Book Creation</h2>
    
    <form action="index.php?action=createBook" method="post" enctype="multipart/form-data" class="book-form">
        
        <div class="form-group">
            <label for="title" class="form-group__label">Title</label>
            <input type="text" 
                   name="title" 
                   id="title" 
                   class="form-group__input" 
                   placeholder="Enter book title"
                   required>
        </div>

        <div class="form-group">
            <label for="author" class="form-group__label">Author</label>
            <input type="text" 
                   name="author" 
                   id="author" 
                   class="form-group__input" 
                   placeholder="Enter author name"
                   required>
        </div>

        <div class="form-group">
            <label for="image" class="form-group__label">Book Cover Image</label>
            <input type="file" 
                   name="image" 
                   id="image" 
                   class="form-group__file" 
                   accept="image/*">
        </div>

        <div class="form-group">
            <label for="description" class="form-group__label">Description</label>
            <textarea name="description" 
                      id="description" 
                      class="form-group__textarea" 
                      rows="6"
                      placeholder="Enter book description"
                      required></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="form-actions__submit">
                Create Book
            </button>
        </div>
        
    </form>
</div>