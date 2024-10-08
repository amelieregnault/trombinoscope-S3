<form action="index.php?page=create-student" method="post" enctype="multipart/form-data">
        <div>
            <label for="firstname">Prénom </label>
            <input type="text" name="firstname" id="firstname" value="<?= isset($student_data) ? $student_data['firstname'] : '' ?>">
        </div>
        <div>
            <label for="lastname">Nom </label>
            <input type="text" name="lastname" id="lastname" value="<?= isset($student_data) ? $student_data['lastname'] : '' ?>">
        </div>
        <div>
            <label for="birthdate">Date d'anniversaire </label>
            <input type="date" name="birthdate" id="birthdate" value="<?= isset($student_data) ? $student_data['birthdate'] : '' ?>">
        </div>
        <div>
            <label for="Group">Groupe </label>
            <select name="group" id="group">
                <option value="12" <?= isset($student_data) && $student_data['group'] == '12' ? 'selected' : '' ?>>Groupe 12</option>
                <option value="34" <?= isset($student_data) && $student_data['group'] == '34' ? 'selected' : '' ?>>Groupe 34</option>
                <option value="56" <?= isset($student_data) && $student_data['group'] == '56' ? 'selected' : '' ?>>Groupe 56</option>
                <option value="78" <?= isset($student_data) && $student_data['group'] == '78' ? 'selected' : '' ?>>Groupe 78</option>
            </select>
        </div>
        <div>
            <label for="description">Description </label>
            <textarea name="description" id="description" cols="30" rows="10"><?= isset($student_data) ? $student_data['description'] : '' ?></textarea>
        </div>
        <div>
            <label for="photo">Image</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <button type="submit" name="submit">Ajouter</button>
    </form>