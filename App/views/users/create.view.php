<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Register</div>
        <?php loadPartial('message'); ?>
        <form action="/auth/register" method="POST">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded"
                    value="<?= $user->name ?>">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded"
                    value="<?= $user->email ?>">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Register</button>
        </form>
    </div>
</section>

<?php loadPartial('bottom-banner'); ?>

<?php loadPartial('footer'); ?>