<?php



class Fileuploader
{

    private $file;
    private $name;
    private $size;
    private $type;
    private $tmp;
    private $error;
    private $extension;

    private $uploadErrors = array();
    private $randomFileName = false;
    private $newFileName = null;
    private $path;
    private $filesErrorMessages = [
        0 => "Tidak ada error, file berhasil diupload",
        1 => "File yang diunggah melebihi kapasitas pada settingan upload_max_filesize di php.ini",
        2 => "File yang diunggah melebihi kapasitas MAX_FILE_SIZE yang ditentukan pada form HTML",
        3 => "File yang diunggah hanya diunggah sebagian",
        4 => "Tidak ada file yang diunggah",
        6 => "Temporary folder tidak ada"
    ];

    /**
     *	Class construct: Atur data file yang diunggah.
     */
    public function __construct(string $file)
    {
        if (isset($_FILES[$file])) {
            // Get data from $_FILES variable.
            $this->file  = $_FILES[$file];
            $this->name  = $this->file['name'];
            $this->size  = $this->file['size'];
            $this->type  = $this->file['type'];
            $this->tmp   = $this->file['tmp_name'];
            $this->error = $this->file['error'];
            $this->extension = $this->parseExtension();
        } else {
            $this->error('Nama file masukan tidak ditentukan');
        }
    }

    /**
     *	Mendapatkan format file
     *	@return string
     */
    private function parseExtension()
    {
        $ext = null;

        if (is_array($this->name)) {
            foreach ($this->name as $value) {
                $ext_values = explode('.', $value);
                $ext_values = end($ext_values);
                $ext[] = '.' . $ext_values;
            }
        } else {
            $ext = explode('.', $this->name);
            $ext = '.' . end($ext);
        }

        return $ext;
    }

    /**
     *	Cek apakah ada file yang diunggah
     *	@return boolean
     */
    private function fileExists()
    {
        $file = null;
        $name = $this->name;

        if (is_array($name)) {
            $name = implode('', $name);
        }

        if (!empty($name)) {
            $file = $name;
        }

        return isset($this->file) && !empty($file) && !is_null($file);
    }

    /**
     *	Membuat Nama File Random
     *	@return void
     */
    public function createRandomName()
    {
        $this->randomFileName = true;
    }

    /**
     *	Membuat nama file baru
     *	@return void
     */
    public function createFileName(string $filename)
    {
        $this->newFileName = $filename;
    }

    /**
     *	Menyesuaikan path tujuan
     *	@param string, $path
     */
    public function path(string $path)
    {
        $path = trim($path, '/');
        $path = trim($path, '\\');
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
        $path = $path . '' . DIRECTORY_SEPARATOR;

        $this->path = $path;
    }

    /**
     *	Unggah file ke tujuan yang ditentukan.
     */
    public function upload()
    {
        if (!$this->fileExists()) {
            $this->error('Pilih file yang akan diunggah.');
        }

        if (empty($this->path) || $this->path == null) {
            $this->error('You have to use path method to specify the destination.');
        }

        $this->move();
    }

    /**
     *	Hasilkan string acak.
     *
     *	@param integer $length
     *	@return string
     */
    public function randomString(int $length = 10)
    {
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $char = str_shuffle($char);
        $charLength = strlen($char);
        $random = null;

        for ($i = 0; $i < $length; $i++) {
            $random .= $char[rand(0, $charLength - 1)];
        }

        return $random;
    }

    private function checkFilesErrors($fileError)
    {
        if ($fileError > 0) {
            $this->uploadErrors[] = $this->filesErrorMessages[$fileError];
        }
    }

    private function error($errorMessage)
    {
        $this->uploadErrors[] = $errorMessage;
    }

    /**
     *	Move uploaded files.
     */
    public function move()
    {
        // Create file directory if not exists
        if (!is_dir($this->path)) {
            mkdir($this->path);
        }

        if (is_array($this->name)) {
            for ($file = 0; $file < count($this->name); $file++) {
                // Get the temp file path
                $tmp = $this->tmp[$file];
                $name = $this->name[$file];

                // Get new file name
                if ($this->randomFileName == true) {
                    $this->newFileName = date('Ymd') . '-' . time() . '-' . $this->randomString();
                    $name = $this->newFileName . $this->extension[$file];
                } elseif (!is_null($this->newFileName)) {
                    $name = $this->newFileName . $this->extension[$file];
                }

                // Check errors
                $this->checkFilesErrors($this->error[$file]);

                // Upload the file
                if (move_uploaded_file($tmp, $this->path . $name)) {
                    // uploaded
                } else {
                    $this->error("Ada yang salah. file ini '{$this->name[$file]}' belum diunggah");
                }
            }
        } else {
            $name = $this->name;

            if ($this->randomFileName == true) {
                $this->newFileName = date('Ymd') . '-' . time() . '-' . $this->randomString();
                $name = $this->newFileName . $this->extension;
            } elseif (!is_null($this->newFileName)) {
                $name = $this->newFileName . $this->extension;
            }

            $this->checkFilesErrors($this->error);

            if (move_uploaded_file($this->tmp, $this->path . $name)) {
                // uploaded
            } else {
                $this->error("Ada yang salah. file ini '{$name}' belum diunggah");
            }
        }
    }

    /**
     *	Get the file name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *	Get the file size.
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     *	Get the file type.
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *	Get the tmp name.
     */
    public function getTmp()
    {
        return $this->tmp;
    }

    /**
     *	Get the file error.
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     *	Get the file extension.
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     *	Check if there is no errors.
     */
    public function success()
    {
        if (empty($this->uploadErrors)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *	Display the upload errors.
     */
    public function displayUploadErrors()
    {
        return $this->uploadErrors;
    }
}
