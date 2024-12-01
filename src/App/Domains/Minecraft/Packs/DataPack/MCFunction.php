<?php namespace App\Domains\Minecraft\Packs\DataPack;

use App\Domains\Minecraft\Packs\PackInterface;
use App\Domains\Minecraft\Packs\PackTrait;
use Celestriode\Mattock\Parsers\Java\Utils\ResourceLocation;

class MCFunction implements PackInterface
{
    use PackTrait;

    public const COMMENT_CHAR = '#';

    protected array $commands;

    public function __construct(ResourceLocation $location, string ...$commands)
    {
        $this->commands = $commands;
        $this->setResourceLocation($location);
    }

    public function addCommand(string $command): void
    {
        $this->commands[] = $command;
    }

    public function addCommands(string ...$commands): void
    {
        foreach ($commands as $command) {

            $this->addCommand($command);
        }
    }

    public function addComment(string $comment): void
    {
        if (!empty($this->getCommands())) {

            $this->addCommand('');
        }

        $this->addCommand( self::COMMENT_CHAR . $comment);
        $this->addCommand('');
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function toString(bool $pretty = false, bool $includeComments = true): string
    {
        if ($includeComments) {

            return implode(PHP_EOL, $this->getCommands());
        }

        return implode(PHP_EOL, array_filter($this->getCommands(), function ($line) {

            return strlen($line) !== 0 && $line[0] !== self::COMMENT_CHAR;
        }));
    }

    protected function getIntermediatePath(): string
    {
        return 'function';
    }

    public static function getExtension(): string
    {
        return '.mcfunction';
    }

    public function getFullPath(): string
    {
        return $this->getPath() . self::getExtension();
    }
}
