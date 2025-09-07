<?php declare(strict_types=1);

namespace Tests\Botfire\Responses;

use Botfire\Responses\AudioMessageResponse;
use Botfire\Responses\Chat;
use Botfire\Responses\From;
use Botfire\Responses\Models\Audio;
use PHPUnit\Framework\TestCase;

final class SendAudioResponseTest extends TestCase
{
    private static array $responseData;

    public static function setUpBeforeClass(): void
    {
        self::$responseData = json_decode(file_get_contents(__DIR__ . "/ResponseTemplates/AudioResponse-1.json"), true);
    }

    public function testResponseIsOk(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertTrue($audioResponse->isOk());
    }

    public function testGetMessageId(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame(4327, $audioResponse->getResult()->getMessageId());
    }

    public function testGetFromId(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame(1222737593, $audioResponse->getResult()->getFrom()->getId());
    }

    public function testGetFromIsBot(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertTrue($audioResponse->getResult()->getFrom()->isBot());
    }

    public function testGetFromFirstName(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame('Demo Test', $audioResponse->getResult()->getFrom()->getFirstName());
    }

    public function testGetFromUsername(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame('MyDemoOneBot', $audioResponse->getResult()->getFrom()->getUsername());
    }

    public function testGetChatId(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame(90680000, $audioResponse->getResult()->getChat()->getId());
    }

    public function testGetChatFirstName(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame('BΞΝ', $audioResponse->getResult()->getChat()->getFirstName());
    }

    public function testGetChatUsername(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame('BOTFIRE', $audioResponse->getResult()->getChat()->getUsername());
    }

    public function testGetChatType(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame('private', $audioResponse->getResult()->getChat()->getType());
    }

    public function testGetDate(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame(1757247013, $audioResponse->getResult()->getDate());
    }

    public function testGetAudioDuration(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame(6, $audioResponse->getResult()->getAudio()->getDuration());
    }

    public function testGetAudioFileName(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame('sample-6s.mp3', $audioResponse->getResult()->getAudio()->getFileName());
    }

    public function testGetAudioMimeType(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame('audio/mpeg', $audioResponse->getResult()->getAudio()->getMimeType());
    }

    public function testGetAudioFileId(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame(
            'CQACAgQAAxkDAAIQ52i9diUiZxQE3yUJ5BwywmxZaSiuAALxAgACHOCFUSER_n04M7UHNgQ',
            $audioResponse->getResult()->getAudio()->getFileId()
        );
    }

    public function testGetAudioFileUniqueId(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame(
            'AgAD8QIAAhzghVE',
            $audioResponse->getResult()->getAudio()->getFileUniqueId()
        );
    }

    public function testGetAudioFileSize(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $this->assertSame(103070, $audioResponse->getResult()->getAudio()->getFileSize());
    }

    public function testGetResultReturnsMessageObject(): void
    {
        $audioResponse = new AudioMessageResponse(self::$responseData);
        $result = $audioResponse->getResult();
        
        $this->assertInstanceOf(From::class, $result->getFrom());
        $this->assertInstanceOf(Chat::class, $result->getChat());
        $this->assertInstanceOf(Audio::class, $result->getAudio());
    }
}