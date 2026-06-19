<?php

/**
 * SiteMeta - 站点元信息管理
 *
 * 维护网站的基本元数据，并提供生成描述性文本的方法
 */
class SiteMeta
{
    /**
     * @var array 站点元信息
     */
    private array $meta = [];

    /**
     * @param array $initial 初始元数据
     */
    public function __construct(array $initial = [])
    {
        $this->meta = $initial;
    }

    /**
     * 设置元信息字段
     *
     * @param string $key
     * @param mixed $value
     * @return self
     */
    public function set(string $key, $value): self
    {
        $this->meta[$key] = $value;
        return $this;
    }

    /**
     * 获取元信息字段
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->meta[$key] ?? $default;
    }

    /**
     * 生成简短描述文本
     *
     * @param string $separator 分隔符
     * @return string
     */
    public function generateDescription(string $separator = ' - '): string
    {
        $parts = [];

        if (!empty($this->meta['title'])) {
            $parts[] = htmlspecialchars($this->meta['title'], ENT_QUOTES, 'UTF-8');
        }

        if (!empty($this->meta['keywords'])) {
            $parts[] = htmlspecialchars($this->meta['keywords'], ENT_QUOTES, 'UTF-8');
        }

        if (!empty($this->meta['url'])) {
            $parts[] = htmlspecialchars($this->meta['url'], ENT_QUOTES, 'UTF-8');
        }

        return implode($separator, $parts);
    }

    /**
     * 获取完整元数据数组
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->meta;
    }
}

// 示例用法：创建站点元信息并生成描述
$siteMeta = new SiteMeta([
    'title'    => 'HTH官方站点',
    'keywords' => 'hth, 娱乐, 平台',
    'url'      => 'https://wap-ssl-hth.com',
    'language' => 'zh-CN',
    'charset'  => 'UTF-8',
]);

$description = $siteMeta->generateDescription(' | ');

echo "站点描述: " . $description . PHP_EOL;
echo "全部元信息: " . print_r($siteMeta->toArray(), true) . PHP_EOL;