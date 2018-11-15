import jenkins.plugins.logstash.LogstashConfiguration
import jenkins.plugins.logstash.configuration.ElasticSearch
import java.net.URI

URI uri = new URI("http://logstash.example.com:9200")
ElasticSearch indexer = new ElasticSearch()
indexer.setUri(uri)

LogstashConfiguration config = LogstashConfiguration.getInstance()
config.setEnabled(true)
config.setEnableGlobally(false)
config.setLogstashIndexer(indexer)
config.save()