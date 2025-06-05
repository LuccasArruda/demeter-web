<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagemModel extends Model
{
    protected $table            = 'imagem';
    protected $primaryKey       = 'ID';
    protected $allowedFields    = ['IMAGEM', 'MIME_TYPE', 'TIPO', 'ID_ORIGEM'];
    protected $useTimestamps    = false;

    /**
     * Salva ou atualiza uma imagem para uma entidade específica.
     *
     * @param int    $idOrigem  ID da entidade (aparelho, ambiente, etc.)
     * @param string $tipo      Tipo da entidade (ex: 'AP', 'AM')
     * @param string $imageData Dados binários da imagem
     * @param string $mimeType  Tipo MIME da imagem
     * @return bool
     */
    public function saveOrUpdateImage(int $idOrigem, string $tipo, string $imageData, string $mimeType): bool
    {
        $existingImage = $this->where('ID_ORIGEM', $idOrigem)
                              ->where('TIPO', $tipo)
                              ->first();

        $data = [
            'ID_ORIGEM' => $idOrigem,
            'TIPO'      => $tipo,
            'IMAGEM'    => $imageData,
            'MIME_TYPE' => $mimeType,
        ];

        if ($existingImage) {
            // Atualiza a imagem existente
            return $this->update($existingImage['ID'], $data);
        } else {
            // Insere uma nova imagem
            return $this->insert($data) !== false;
        }
    }

    /**
     * Obtém uma imagem pelo ID da origem e tipo.
     *
     * @param int    $idOrigem
     * @param string $tipo
     * @return array|null
     */
    public function getImage(int $idOrigem, string $tipo): ?array
    {
        return $this->where('ID_ORIGEM', $idOrigem)
                    ->where('TIPO', $tipo)
                    ->first();
    }

    /**
     * Deleta uma imagem pelo ID da origem e tipo.
     *
     * @param int $idOrigem
     * @param string $tipo
     * @return bool
     */
    public function deleteImage(int $idOrigem, string $tipo): bool
    {
         return $this->where('ID_ORIGEM', $idOrigem)
                     ->where('TIPO', $tipo)
                     ->delete() !== false;
    }
}

?>