<?php

class StorableItemTest extends RakiTest 
{
    private $manager = null;
    private $workspaceManager = null;

    public function setUp() 
    {
        $this->manager = $this->getTransition()->getContentManager();
        $this->workspaceManager = $this->getTransition()->getWorkspaceManager();
    }

    public function testGetPath()
    {
        $rf = self::getFixture(__FUNCTION__);
        $paths = $rf->getWorkspacePaths();
        foreach ($paths as $path) {
            $types = $rf->getTypesByWorkspacePath($path);
            foreach ($types as $type) {
                $itemPaths = $rf->getItemsByWorkspacePath($path, $type);
                foreach ($itemPaths as $itemPath => $props) {
                    $ws = $this->workspaceManager->getStoredWorkspaceByPath($path);
                    $item = $this->manager->getItemByPath($ws, $type, $itemPath);
                    $this->assertInstanceOf("\CRTransition\StorableItem", $item, "Item '{$type}' not found at '{$path}' path\n");
                    $this->assertEquals($itemPath, $item->getPath());
                }
            }
        }
    }

    public function testGetName()
    {
        $rf = self::getFixture(__FUNCTION__);
        $paths = $rf->getWorkspacePaths();
        foreach ($paths as $path) {
            $types = $rf->getTypesByWorkspacePath($path);
            foreach ($types as $type) {
                $itemPaths = $rf->getItemsByWorkspacePath($path, $type);
                foreach ($itemPaths as $itemPath => $props) {
                    $ws = $this->workspaceManager->getStoredWorkspaceByPath($path);
                    $item = $this->manager->getItemByPath($ws, $type, $itemPath);
                    $this->assertInstanceOf("\CRTransition\StorableItem", $item);
                    if (isset($props['name'])) {
                        $this->assertEquals($props['name'], $item->getName(), "Type {$type} at {$path}/{$itemPath}");
                    }
                }
            }
        }
    }

    public function testGetProperty()
    {
        $rf = self::getFixture(__FUNCTION__);
        $paths = $rf->getWorkspacePaths();
        foreach ($paths as $path) {
            $types = $rf->getTypesByWorkspacePath($path);
            foreach ($types as $type) {
                $itemPaths = $rf->getItemsByWorkspacePath($path, $type);
                foreach ($itemPaths as $itemPath => $props) {
                    $ws = $this->workspaceManager->getStoredWorkspaceByPath($path);
                    $item = $this->manager->getItemByPath($ws, $type, $itemPath);
                    $this->assertInstanceOf("\CRTransition\StorableItem", $item);
                    foreach ($props as $name => $value) {
                        //echo "PROPERTY {$name} : {$item->getProperty($name)} \n";
                        $this->assertEquals($value, $item->getProperty($name), "Type {$type} at {$path}/{$itemPath}, property {$name}.");
                    }
                }
            }
        }
    }
}

?>

