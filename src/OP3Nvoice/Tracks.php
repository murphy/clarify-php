<?php

namespace OP3Nvoice;

class Tracks extends Subresource
{
    protected $subresource = 'o3v:tracks';

    public function load($id)
    {
        $trackURI = $this->getSubresourceURI($id);

        $request = $this->client->get($trackURI, array(), array('exceptions' => false));
        $request->addHeader('Authorization', $this->apiKey);
        $response = $request->send();
        $this->detail = $response->json();

        return $response->json();
    }

    public function update($id, $track = 0, $label ='', $media_url = '', $audio_channel = '', $source = '', $version = '')
    {
        $trackURI = $this->getSubresourceURI($id);

        $request = $this->client->put($trackURI, array(), '', array('exceptions' => false));
        $request->setPostField('track', $track);
        $request->setPostField('label', $label);
        $request->setPostField('media_url', $media_url);
        $request->setPostField('audio_channel', $audio_channel);
        $request->setPostField('source', $source);
        $request->setPostField('version', $version);

        $request->addHeader('Authorization', $this->apiKey);
        $response = $request->send();
        $this->detail = $response->json();

        return $response->isSuccessful();
    }

    public function create($id, $media_url, $label = '', $audio_channel = '', $source = '')
    {
        $trackURI = $this->getSubresourceURI($id);

        $request = $this->client->post($trackURI, array(), '', array('exceptions' => false));
        $request->setPostField('media_url', $media_url);
        $request->setPostField('label', $label);
        $request->setPostField('audio_channel', $audio_channel);
        $request->setPostField('source', $source);

        $request->addHeader('Authorization', $this->apiKey);
        $response = $request->send();
        $this->detail = $response->json();

//todo: we should probably get the Location header for this one too

        return $response->isSuccessful();
    }

    public function delete($id)
    {
        $trackURI = $this->getSubresourceURI($id);

        $request = $this->client->delete($trackURI, array(), '', array('exceptions' => false));

        $request->addHeader('Authorization', $this->apiKey);
        $response = $request->send();
        $this->detail = $response->json();

        return $response->isSuccessful();
    }
}