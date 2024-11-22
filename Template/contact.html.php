<div class="p-4 w-full h-full">
    <div class="flex items-center justify-center">
        <div class="flex flex-col items-center justify-center h-1/2 w-1/2 p-4 rounded-md bg-white">
            <p class="text-2xl font-bold">Contact to admin</p>
            <form action="../PHP/contact.php" method="POST" class="mt-4">
                <div class="flex flex-col space-y-4">
                    <textarea type="text" name="subject" placeholder="Subject"></textarea>
                    <textarea type="text" name="body" placeholder="Body"></textarea>
                    <textarea type="text" name="altbody" placeholder="Alternative Body"></textarea>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Send
                    </button>
                </div>
            </form>
        </div>  
    </div>
</div>